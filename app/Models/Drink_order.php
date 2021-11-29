<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink_order extends Model
{
    use HasFactory;

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
