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
        
        // Services de traduction disponibles
        $serviceTypes = [
            'Traduction de documents',
            'Traduction de site web',
            'Traduction juridique',
            'Traduction technique',
            'Traduction médicale',
            'Interprétation',
            'Localisation de logiciel',
            'Sous-titrage',
        ];
        
        // Statuts possibles
        $statuses = ['pending', 'in_progress', 'completed'];
        
        // Langues pour origine/destination
        $languages = [
            'Français', 'Anglais', 'Espagnol', 'Allemand', 'Italien', 
            'Portugais', 'Russe', 'Chinois', 'Japonais', 'Arabe'
        ];
        
        // Créer 50 demandes de devis
        for ($i = 0; $i < 50; $i++) {
            $createdAt = $faker->dateTimeBetween('-3 months', 'now');
            
            Quote::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'company' => $faker->optional(0.7)->company(),
                'service_type' => $faker->randomElement($serviceTypes),
                'origin' => $faker->randomElement($languages),
                'destination' => $faker->randomElement($languages),
                'details' => $faker->paragraphs(rand(1, 3), true),
                'status' => $faker->randomElement($statuses),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
