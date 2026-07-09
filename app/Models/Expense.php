<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_date',
        'category',
        'description',
        'supplier',
        'amount',
        'currency',
        'usd_rate',
        'method',
        'notes',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
        'usd_rate' => 'decimal:2',
    ];

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
