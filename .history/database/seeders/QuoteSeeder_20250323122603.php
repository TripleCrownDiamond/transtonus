<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        
        // Services de transport disponibles (repris du fichier messages.php)
        $serviceTypes = [
            'storage' => 'Stockage',
            'logistics' => 'Logistique',
            'cargo' => 'Transport de Fret',
            'trucking' => 'Transport Routier',
            'packaging' => 'Emballage',
            'warehousing' => 'Entreposage',
        ];
        
        // Statuts possibles
        $statuses = ['pending', 'in_progress', 'completed'];
        
        // Locales disponibles
        $locales = ['fr', 'en', 'es', 'de'];
        
        // Créer 50 demandes de devis
        for ($i = 0; $i < 50; $i++) {
            $createdAt = $faker->dateTimeBetween('-3 months', 'now');
            $locale = $faker->randomElement($locales);
            $serviceKey = $faker->randomElement(array_keys($serviceTypes));
            
            Quote::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'company' => $faker->optional(0.7)->company(),
                'service_type' => $serviceTypes[$serviceKey],
                'origin' => $faker->city(),
                'destination' => $faker->city(),
                'details' => $faker->paragraphs(rand(1, 3), true),
                'status' => $faker->randomElement($statuses),
                'locale' => $locale,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
