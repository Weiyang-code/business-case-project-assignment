<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'food'; //input table name else will use menu table but we dont have cuz we use food table instead of menu

    protected $fillable = ['name', 'description', 'price', 'image'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'food_id');
    }
}