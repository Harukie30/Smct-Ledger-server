<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Installment extends Model
{
    protected $guarded = [];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id');
    }

    public function installmentLedgers(): HasMany
    {
        return $this->hasMany(InstallmentLedger::class, 'installment_id');
    }

    public function installmentPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'installment_id');
    }

    #[Scope]
    public function search(Builder $builder , ?string $term)
    {
        $builder->when(
            $term,
            fn($q)
            =>
            $q->where(
                fn($s)
                =>
                $s->whereAny(
                    [
                        'location_id',
                        'internal_id',
                        'customer_name',
                        'so_number',
                        'purchase_date',
                        'item',
                        'item_class'
                    ], 'LIKE', "%{$term}%"
                )
                ->orWhereHas('location', fn($r) => $r->whereLike('location_name', "{$term}"))
            )
        );
    }
}
