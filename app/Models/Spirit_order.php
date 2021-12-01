<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spirit_order extends Model
{
    use HasFactory;
    protected $fillable = ['id','quantify','price', 'spirit_id', 'order_id'];

    public function spirits()
    {
        return $this->belongsToMany(Spirit::class, Spirit_order::class, 'spirit_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
