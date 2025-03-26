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
        'current_location',
        'departure_date',
        'estimated_arrival_date',
        'status',
        'shipment_type',
        'recipient_name',
        'recipient_email',
        'recipient_address',
        'recipient_city',
        'recipient_postal_code',
        'recipient_phone',
        'sender_name',
        'sender_email',
        'sender_address',
        'sender_city',
        'sender_postal_code',
        'sender_phone',
        'locale',
        'additional_info',
        'history',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array
     */
    protected $casts = [
        'departure_date' => 'datetime',
        'estimated_arrival_date' => 'datetime',
        'history' => 'array',
    ];

    /**
     * Get the payments for the shipment.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}