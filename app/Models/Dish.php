<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'description', 'price', 'stock'];
    // public function dish_Orders()
    // {
    //     return $this->hasMany(Dish_order::class, 'id');
    // }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
