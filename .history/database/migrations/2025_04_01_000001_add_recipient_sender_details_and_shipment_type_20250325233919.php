<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Informations du destinataire
            $table->string('recipient_address')->nullable()->after('recipient_email');
            $table->string('recipient_city')->nullable()->after('recipient_address');
            $table->string('recipient_postal_code')->nullable()->after('recipient_city');
            $table->string('recipient_phone')->nullable()->after('recipient_postal_code');

            // Informations de l'expéditeur
            $table->string('sender_email')->nullable()->after('sender_name');
            $table->string('sender_address')->nullable()->after('sender_email');
            $table->string('sender_city')->nullable()->after('sender_address');
            $table->string('sender_postal_code')->nullable()->after('sender_city');
            $table->string('sender_phone')->nullable()->after('sender_postal_code');

            // Type de fret
            $table->enum('shipment_type', [
                'maritime',
                'aerien',
                'ferroviaire',
                'express',
                'camion',
                'vehicule',
                'multimodal',
                'conteneur',
                'vrac',
                'refrigere',
                'dangereux',
                'colis',
                'palette'
            ])->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Supprimer les colonnes du destinataire
            $table->dropColumn([
                'recipient_address',
                'recipient_city',
                'recipient_postal_code',
                'recipient_phone'
            ]);

            // Supprimer les colonnes de l'expéditeur
            $table->dropColumn([
                'sender_email',
                'sender_address',
                'sender_city',
                'sender_postal_code',
                'sender_phone'
            ]);

            // Supprimer le type de fret
            $table->dropColumn('shipment_type');
        });
    }
};