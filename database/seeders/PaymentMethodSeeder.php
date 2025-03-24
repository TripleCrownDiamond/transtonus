<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'Virement bancaire',
                'code' => 'bank_transfer',
                'description' => 'Paiement par virement bancaire',
                'is_active' => true,
            ],
            [
                'name' => 'Carte de crédit',
                'code' => 'credit_card',
                'description' => 'Paiement par carte de crédit (Visa, Mastercard, etc.)',
                'is_active' => true,
            ],
            [
                'name' => 'PayPal',
                'code' => 'paypal',
                'description' => 'Paiement via PayPal',
                'is_active' => true,
            ],
            [
                'name' => 'Espèces à la livraison',
                'code' => 'cash_on_delivery',
                'description' => 'Paiement en espèces à la livraison',
                'is_active' => true,
            ],
            [
                'name' => 'Chèque',
                'code' => 'check',
                'description' => 'Paiement par chèque',
                'is_active' => true,
            ],
        ];

        foreach ($paymentMethods as $method) {
            DB::table('payment_methods')->insert($method);
        }
    }
}