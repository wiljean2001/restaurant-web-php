<?php

namespace App\Models;

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish_order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'quantify', 'price', 'dish_id', 'order_id'];
    
// Relacion entre la tabla dish_orders y dishes ` uno a muchos inverso
    public function dishes()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
