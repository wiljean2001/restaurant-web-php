<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spirit extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'description', 'price', 'stock'];
    public function spirit_Orders()
    {
        return $this->hasMany(Spirit_order::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
