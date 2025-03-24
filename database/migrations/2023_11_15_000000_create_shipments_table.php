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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->string('origin');
            $table->string('destination');
            $table->date('departure_date');
            $table->date('estimated_arrival_date');
            $table->enum('status', [
                'processing', 
                'in_transit', 
                'out_for_delivery', 
                'delivered', 
                'delayed', 
                'exception'
            ])->default('processing');
            $table->json('history')->nullable();
            $table->string('recipient_name');
            $table->string('sender_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};