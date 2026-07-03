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
        'method',
        'notes',
    ];

    protected $casts = [
        'expense_date' => 'date',
    ];
}
