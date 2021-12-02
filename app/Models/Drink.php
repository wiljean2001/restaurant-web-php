<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'description', 'price', 'stock'];
    public function drink_Orders()
    {
        return $this->hasMany(Drink_order::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
