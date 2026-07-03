<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'stage',
        'responsible',
        'start_date',
        'end_date',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}