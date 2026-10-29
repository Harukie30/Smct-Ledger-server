<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = [];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class,'location_id');
    }

    public function installment(): BelongsTo
    {
        return $this->belongsTo(Installment::class,'installment_id');
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
                        'document_number',
                        'or_number',
                        'customer_name',
                        'invoice_number',
                    ], 'LIKE', "%{$term}%"
                )
                ->orWhereHas('location', fn($r) => $r->whereLike('location_name', "{$term}"))
                ->orWhereHas(
                    'installment',
                    fn($r)
                    =>
                    $r->whereAny(
                        [
                            'document_number',
                            'or_number',
                            'customer_name',
                            'invoice_number',
                        ], 'LIKE', "%{$term}%"
                    )
                )
            )
        );
    }
}
