<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'food_id', 'quantity'];

    // Relationship with Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'food_id');
    }
    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
