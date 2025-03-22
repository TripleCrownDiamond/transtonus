<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tracking_number',
        'origin',
        'destination',
        'departure_date',
        'estimated_arrival_date',
        'status',
        'history',
        'recipient_name',
        'sender_name',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array
     */
    protected $casts = [
        'departure_date' => 'date',
        'estimated_arrival_date' => 'date',
        'history' => 'array',
    ];
}