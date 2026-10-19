<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstallmentLedger extends Model
{
    protected $guarded = [];

    public function installment(): BelongsTo
    {
        return $this->belongsTo(Installment::class,'installment_id');
    }
}
