<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /**
     * Les colonnes qui peuvent être massivement assignées.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address', // Adresse IP du visiteur
        'country',    // Pays du visiteur
        'route',      // Route visitée
    ];
}
