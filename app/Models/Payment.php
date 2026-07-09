<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_date',
        'amount',
        'currency',
        'usd_rate',
        'method',
        'reference',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
        'usd_rate' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function currencySymbol(): string
    {
        return $this->currency === 'USD' ? 'U$D' : '$';
    }

    public function getAmountArsAttribute()
    {
        if ($this->currency === 'USD' && $this->usd_rate) {
            return (float) $this->amount * (float) $this->usd_rate;
        }

        return (float) $this->amount;
    }
}
