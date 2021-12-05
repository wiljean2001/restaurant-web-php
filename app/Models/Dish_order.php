<?php

namespace App\Models;

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish_order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'quantify', 'price', 'dish_id', 'order_id'];

    public function dishes()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
    // belongsToMany -> relacionar la tabla dishes con orders 
    // hasManyThrough
    // hasMany
    // return $this->belongsTo(Dish::class);
    // return $this->hasManyThrough(Dish::class, Dish_order::class, 'dish_id', 'id');
    // return $this->belongsToMany(Dish::class, Dish_order::class, 'dish_id', 'id');
    // return $this->hasManyThrough(Dish::class, Dish_order::class, 'dish_id', 'id');
    // return $this->belongsToMany(Dish::class, Dish_order::class, 'dish_id', 'id');
    // return $this->hasManyThrough(Dish::class, Dish_order::class, 'dish_id', 'id');

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
