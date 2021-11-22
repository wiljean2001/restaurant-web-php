<?php

namespace App\Http\Controllers;

use App\Models\Spirit_order;
use Illuminate\Http\Request;

class Spirit_orderController extends Controller
{
    public function create(Request $request)
    {
        $dish_Order = new Spirit_order();
        $dish_Order->quantify = $request->quantify;
        $dish_Order->dishID = $request->id;
        $dish_Order->orderID = $request->idOrder;
        if ($dish_Order->save()) {
            back()->with('message', 'Dish agregado al pedido correctamente');
            return redirect()->route('menu-restaurant');
        }
    }
}
