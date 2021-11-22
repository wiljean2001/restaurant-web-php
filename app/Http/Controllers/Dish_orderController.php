<?php

namespace App\Http\Controllers;

use App\Models\Dish_order;
use Illuminate\Http\Request;

class Dish_orderController extends Controller
{
    public function create(Request $request)
    {
        back()->with('orderId', '' . $request->session()->get('orderId'));
        $dish_Order = new Dish_order();
        $dish_Order->quantify = $request->quantify;
        $dish_Order->dishID = $request->id;
        $dish_Order->orderID = $request->idOrder;
        if ($dish_Order->save()) {
            back()->with('message', 'Dish agregado al pedido correctamente');
            return redirect()->route('menu-restaurant');
        }
    }
}
