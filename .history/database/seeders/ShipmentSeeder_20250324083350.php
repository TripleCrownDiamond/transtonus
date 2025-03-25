<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $currencies = DB::table('currencies')->pluck('id')->toArray();
        $paymentMethods = DB::table('payment_methods')->pluck('id', 'code')->toArray();
        
        // Create 20 shipments with payments
        for ($i = 0; $i < 20; $i++) {
            $departureDate = Carbon::now()->subDays(rand(1, 30));
            $estimatedArrival = (clone $departureDate)->addDays(rand(3, 15));
            
            // Determine status based on dates
            $today = Carbon::now();
            $status = 'processing';
            
            if ($departureDate->lte($today)) {
                if ($estimatedArrival->lte($today)) {
                    $status = $faker->randomElement(['delivered', 'exception']);
                } else {
                    $status = $faker->randomElement(['in_transit', 'out_for_delivery', 'delayed']);
                }
            }
            
            // Create history based on status
            $history = [];
            $history[] = [
                'date' => $departureDate->format('Y-m-d H:i:s'),
                'status' => 'processing',
                'location' => $faker->city,
                'description' => 'Shipment registered'
            ];
            
            if (in_array($status, ['in_transit', 'out_for_delivery', 'delivered', 'delayed', 'exception'])) {
                $history[] = [
                    'date' => $departureDate->addDays(1)->format('Y-m-d H:i:s'),
                    'status' => 'in_transit',
                    'location' => $faker->city,
                    'description' => 'Shipment has departed from origin'
                ];
            }
            
            if (in_array($status, ['out_for_delivery', 'delivered', 'exception'])) {
                $history[] = [
                    'date' => $estimatedArrival->subDays(1)->format('Y-m-d H:i:s'),
                    'status' => 'out_for_delivery',
                    'location' => $faker->city,
                    'description' => 'Shipment out for delivery'
                ];
            }
            
            if ($status === 'delivered') {
                $history[] = [
                    'date' => $estimatedArrival->format('Y-m-d H:i:s'),
                    'status' => 'delivered',
                    'location' => $faker->city,
                    'description' => 'Shipment delivered successfully'
                ];
            }
            
            if ($status === 'delayed') {
                $history[] = [
                    'date' => $faker->dateTimeBetween($departureDate, $estimatedArrival)->format('Y-m-d H:i:s'),
                    'status' => 'delayed',
                    'location' => $faker->city,
                    'description' => 'Shipment delayed due to ' . $faker->randomElement(['weather conditions', 'technical issues', 'customs clearance'])
                ];
            }
            
            if ($status === 'exception') {
                $history[] = [
                    'date' => $faker->dateTimeBetween($departureDate, $estimatedArrival)->format('Y-m-d H:i:s'),
                    'status' => 'exception',
                    'location' => $faker->city,
                    'description' => 'Shipment has an exception: ' . $faker->randomElement(['damaged package', 'address not found', 'recipient not available'])
                ];
            }
            
            // Get current location based on history
            $currentLocation = end($history)['location'];
            
            // Create shipment
            $shipmentId = DB::table('shipments')->insertGetId([
                'tracking_number' => 'TRK' . strtoupper($faker->bothify('##???####')),
                'origin' => $faker->city . ', ' . $faker->country,
                'destination' => $faker->city . ', ' . $faker->country,
                'current_location' => $currentLocation,
                'departure_date' => $departureDate->format('Y-m-d'),
                'estimated_arrival_date' => $estimatedArrival->format('Y-m-d'),
                'status' => $status,
                'history' => json_encode($history),
                'recipient_name' => $faker->name,
                'sender_name' => $faker->company,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
            // Create payment for shipment
            $paymentStatus = $faker->randomElement(['pending', 'paid', 'failed']);
            $paidAt = null;
            if ($paymentStatus === 'paid') {
                $paidAt = Carbon::now()->subDays(rand(1, 10));
            }
            
            $paymentMethodCode = $faker->randomElement(array_keys($paymentMethods));
            $paymentMethodId = $paymentMethods[$paymentMethodCode];
            
            DB::table('payments')->insert([
                'shipment_id' => $shipmentId,
                'currency_id' => $faker->randomElement($currencies),
                'amount' => $faker->randomFloat(2, 50, 1000),
                'percentage' => $faker->randomElement([25, 50, 75, 100]),
                'payment_method' => $paymentMethodCode,
                'instructions' => $paymentMethodCode === 'bank_transfer' ? 'Please include tracking number in transfer reference' : null,
                'status' => $paymentStatus,
                'paid_at' => $paidAt,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
    
    /**
     * Generate formatted additional info for shipments
     */
    private function generateAdditionalInfo($faker): string
    {
        $addressLine = $faker->streetAddress;
        $city = $faker->city;
        $postalCode = $faker->postcode;
        $country = $faker->country;
        $phone = $faker->phoneNumber;
        
        $infoTypes = [
            // Simple address format
            "**Adresse de livraison:**\n{$addressLine}\n{$postalCode} {$city}\n{$country}\n\n**Téléphone:** {$phone}",
            
            // With special instructions
            "**Adresse:**\n{$addressLine}\n{$postalCode} {$city}\n{$country}\n\n**Contact:** {$phone}\n\n_Instructions spéciales:_ " . $faker->sentence(10),
            
            // With sender and recipient info
            "**Destinataire:**\n" . $faker->name . "\n{$addressLine}\n{$postalCode} {$city}\n{$country}\n**Tel:** {$phone}\n\n**Expéditeur:**\n" . $faker->company . "\n" . $faker->phoneNumber,
            
            // With delivery notes
            "**Adresse complète:**\n{$addressLine}\n{$postalCode} {$city}\n{$country}\n\n*Heures de livraison préférées:* " . $faker->randomElement(['Matin', 'Après-midi', 'Soirée']) . "\n**Commentaire:** " . $faker->sentence(8)
        ];
        
        return $faker->randomElement($infoTypes);
    }
}