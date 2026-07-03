<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'project',
        'room',
        'title',
        'price',
        'cost',
        'delivery_date',
        'status',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getProfitAttribute()
    {
        return $this->price - $this->cost;
    }
    
    public function payments()
{
    return $this->hasMany(Payment::class);
}

public function getCollectedAttribute()
{
    return $this->payments()->sum('amount');
}

public function getBalanceAttribute()
{
    return $this->price - $this->collected;
}
}