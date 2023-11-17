<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'amount',
        'payer',
        'due_on',
        'vat',
        'is_vat_inclusive'
    ];
    /**
     * Get the payer that owns the Transaction
     * @return BelongsTo
     * */
    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payments for this transaction.
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
