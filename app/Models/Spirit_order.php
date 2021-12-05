<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spirit_order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'quantify', 'price', 'spirit_id', 'order_id'];

    public function spirits()
    {
        return $this->belongsTo(Spirit::class, 'spirit_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
