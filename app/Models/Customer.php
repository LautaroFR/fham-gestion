<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Payment;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'notes',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getOrdersCountAttribute()
    {
        return $this->orders()->count();
    }

    public function getTotalSoldAttribute()
    {
        return $this->orders()->get()->sum(fn (Order $order) => $order->price_ars);
    }

    public function getTotalCollectedAttribute()
    {
        return Payment::whereIn('order_id', $this->orders()->pluck('id'))
            ->get()
            ->sum(fn (Payment $payment) => $payment->amount_ars);
    }

    public function getPendingAttribute()
    {
        return $this->total_sold - $this->total_collected;
    }
}
