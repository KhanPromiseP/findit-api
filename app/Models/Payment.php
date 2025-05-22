<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'transaction_id',
        'tx_ref',
        'amount',
        'currency',
        'status',
        'payment_method',
        'customer_email',
        'failure_reason',
        'metadata',
        'verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'verified_at' => 'datetime',
        'metadata' => 'array'
    ];

    /**
     * Get the user that made the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for successful payments.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'successful');
    }

    /**
     * Scope for failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Check if payment is successful.
     */
    public function isSuccessful(): bool
    {
        return $this->status === 'successful';
    }

    /**
     * Get the formatted amount with currency.
     */
    public function getFormattedAmountAttribute(): string
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }
}