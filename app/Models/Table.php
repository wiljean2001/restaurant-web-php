<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'num_table', 'capacity', 'state'];

    public function table_order()
    {
        return $this->hasMany(Order::class);
    }
}
