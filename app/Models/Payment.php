<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'currency_id',
        'amount',
        'percentage',
        'payment_method',
        'instructions',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'percentage' => 'integer',
        'paid_at' => 'datetime',
    ];

    /**
     * Get the shipment that owns the payment.
     */
    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    /**
     * Get the currency associated with the payment.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}