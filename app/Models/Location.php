<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $guarded = [];

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class, 'location_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Installment::class, 'location_id');
    }
}
