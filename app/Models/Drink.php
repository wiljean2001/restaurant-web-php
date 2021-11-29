<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    public function drink_Orders()
    {
        return $this->hasMany(Drink_order::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
