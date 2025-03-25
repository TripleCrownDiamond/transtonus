<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Autres seeders
        $this->call([
            // UserSeeder::class,
            AdminUserSeeder::class,
            //QuoteSeeder::class,
            CurrencySeeder::class,
            PaymentMethodSeeder::class,
            //ShipmentSeeder::class,
        ]);
    }
}
