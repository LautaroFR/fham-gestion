<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_date',
        'project',
        'room',
        'title',
        'price',
        'cost',
        'delivery_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getProfitAttribute()
    {
        return (float) $this->price - (float) $this->cost;
    }

    public function getCollectedAttribute()
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return (float) $this->price - (float) $this->collected;
    }

    public function getPaymentStatusAttribute()
    {
        if ($this->collected <= 0) {
            return 'Sin cobrar';
        }

        if ($this->balance <= 0) {
            return 'Cobrado';
        }

        return 'Parcial';
    }
}
