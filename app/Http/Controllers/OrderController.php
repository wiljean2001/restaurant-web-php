<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Drink;
use App\Models\Spirit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $dishes = DB::table('Dishes')
            ->select(['id', 'name', 'description', 'price', 'stock', 'image'])
            ->paginate(6);
        $drinks = DB::table('Drinks')
            ->select(['id', 'name', 'description', 'price', 'stock', 'image'])
            ->paginate(6);
        $spirits = DB::table('Spirits')
            ->select(['id', 'name', 'description', 'price', 'stock', 'image'])
            ->paginate(6);

        return view('orders.index', compact('dishes', 'drinks', 'spirits'));
    }
}
