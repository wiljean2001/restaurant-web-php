<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Dish_order;
use Exception;
use Illuminate\Http\Request;

class Dish_orderController extends Controller
{
    public function create(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            return redirect()->route('menu-restaurant')
                ->with('error', 'Error, por favor genere una orden');
        }
        back()->with('tableID', $request->session()->get('tableID'));
        // back()->with('dishOrder', $request->session()->get('dishOrder'));
        back()->with('orderId', $request->session()->get('orderId'));
        $dish_Order = Dish_order::create([
            'quantify' => $request->quantify,
            'price' => $request->quantify * $request->priceDish,
            'dish_id' => $request->id,
            'order_id' => $request->idOrder,
        ]);
        if ($dish_Order->save()) {
            return redirect()->route('menu-restaurant')
                ->with('message', 'Plato agregado a la orden correctamente')
                ->with('dishOrder', $dish_Order->id);
        }
    }
}
        // if ($request->session()->has('dishOrder')) {
        //     $d = $request->session()->get('dishOrder');
        //     // printf($dis);
        //     $dish_Order = Dish_order::create([
        //         'id' => $d,
        //         'quantify' => $request->quantify,
        //         'price' => $request->quantify * $request->priceDish,
        //         'dish_id' => $request->id,
        //         'order_id' => $request->idOrder,
        //     ]);
        //     if ($dish_Order->save()) {
        //         // dd($dish_Order);
        //         return redirect()->route('menu-restaurant')
        //             ->with('message', 'Plato agregado a la orden correctamente')
        //             ->with('dishOrder', $dish_Order->id);
        //     }
        // } else {
        //     $dish = Dish_order::select('id')->max('id');
        //     // dd($dish);
        //     if (!$dish) {
        //         $dish = 1;
        //         $dish_Order = Dish_order::create([
        //             'id' => $dish,
        //             'quantify' => $request->quantify,
        //             'price' => $request->quantify * $request->priceDish,
        //             'dish_id' => $request->id,
        //             'order_id' => $request->idOrder,
        //         ]);
        //         if ($dish_Order->save()) {
        //             return redirect()->route('menu-restaurant')
        //                 ->with('message', 'Plato agregado a la orden correctamente')
        //                 ->with('dishOrder', $dish_Order->id);
        //         }
        //     }