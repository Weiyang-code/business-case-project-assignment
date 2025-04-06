<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'food'; //input table name else will use menu table but we dont have cuz we use food table instead of menu

    protected $fillable = ['name', 'description', 'restaurant_id', 'price', 'image', 'calories', 'vegetarian', 'active'];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'food_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'food_id', 'order_id');
    }

    public function restaurant()
{
    return $this->belongsTo(Restaurant::class, 'restaurant_id');
}
}