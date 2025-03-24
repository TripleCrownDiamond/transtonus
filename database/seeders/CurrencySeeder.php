<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        $currencies = [
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'is_default' => true,
            ],
            [
                'code' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
                'is_default' => false,
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound',
                'symbol' => '£',
                'is_default' => false,
            ],
            [
                'code' => 'CHF',
                'name' => 'Swiss Franc',
                'symbol' => 'CHF',
                'is_default' => false,
            ],
            [
                'code' => 'SEK',
                'name' => 'Swedish Krona',
                'symbol' => 'kr',
                'is_default' => false,
            ],
            [
                'code' => 'NOK',
                'name' => 'Norwegian Krone',
                'symbol' => 'kr',
                'is_default' => false,
            ],
            [
                'code' => 'DKK',
                'name' => 'Danish Krone',
                'symbol' => 'kr',
                'is_default' => false,
            ],
            [
                'code' => 'PLN',
                'name' => 'Polish Złoty',
                'symbol' => 'zł',
                'is_default' => false,
            ],
            [
                'code' => 'CZK',
                'name' => 'Czech Koruna',
                'symbol' => 'Kč',
                'is_default' => false,
            ],
            [
                'code' => 'HUF',
                'name' => 'Hungarian Forint',
                'symbol' => 'Ft',
                'is_default' => false,
            ],
            [
                'code' => 'RON',
                'name' => 'Romanian Leu',
                'symbol' => 'lei',
                'is_default' => false,
            ],
            [
                'code' => 'BGN',
                'name' => 'Bulgarian Lev',
                'symbol' => 'лв',
                'is_default' => false,
            ],
            [
                'code' => 'HRK',
                'name' => 'Croatian Kuna',
                'symbol' => 'kn',
                'is_default' => false,
            ],
            [
                'code' => 'ISK',
                'name' => 'Icelandic Króna',
                'symbol' => 'kr',
                'is_default' => false,
            ],
        ];

        foreach ($currencies as $currency) {
            DB::table('currencies')->insert($currency);
        }
    }
}
