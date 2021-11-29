<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spirit_order extends Model
{
    use HasFactory;

    public function spirits()
    {
        return $this->belongsTo(Spirit::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
