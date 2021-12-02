<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink_order extends Model
{
    use HasFactory;
    protected $fillable = ['id','quantify','price', 'drink_id', 'order_id'];

    public function drinks()
    {
        return $this->belongsToMany(Drink::class, Drink_order::class, 'drink_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
