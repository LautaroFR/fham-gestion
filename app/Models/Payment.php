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
        'method',
        'reference',
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}