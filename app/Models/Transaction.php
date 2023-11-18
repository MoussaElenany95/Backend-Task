<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * get the total amount
     * @return Attribute
     */
    public function total(): Attribute
    {
        return Attribute::make(
            // get the value
            get: function($value){
                return !$this->is_vat_inclusive ? $this->amount : $this->amount + ($this->amount * $this->vat/100);
            },
        );
    }
    /**
     * get the transaction status
     * @return string
     */
    public function status(): Attribute
    {
        return Attribute::make(
            // get the value
            get: function($value){
                $paid  = $this->payments->sum('amount');
                $total = $this->total; 
                if($paid == $total){
                    return "Paid";
                }
                else if($paid < $total && $this->due_on > now()){
                    return "Outstanding";
                }
                else{
                    return "Overdue";
                }
            },
        );
    }
    /**
     * Get the payer that owns the Transaction
     * @return BelongsTo
     * */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payer');
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
