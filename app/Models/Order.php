<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id','date', 'tableID', 'userID'];

    public function dish_Orders()
    {
        return $this->hasMany(Dish_order::class);
    }
    public function drink_Orders()
    {
        return $this->hasMany(Drink_order::class);
    }
    public function spirit_Orders()
    {
        return $this->hasMany(Spirit_order::class);
    }
    public function tables()
    {
        return $this->belongsTo(Table::class, 'tableID');
    }
}
