<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink_order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'quantify', 'price', 'drink_id', 'order_id'];

    public function drinks()
    {
        return $this->belongsTo(Drink::class, 'drink_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
