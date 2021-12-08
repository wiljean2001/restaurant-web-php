<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'dni', 'name', 'lname', 'date_of_birth'];
}
