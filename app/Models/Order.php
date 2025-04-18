<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
        'delivery_address',
        'notes',
        'restaurant',
        'placed_at',
        'vendor_id',
        'rider_id'
    ];

    protected $casts = [
        'placed_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
