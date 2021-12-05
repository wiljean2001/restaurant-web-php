<?php

namespace App\Http\Controllers;

use App\Models\Spirit_order;
use Exception;
use Illuminate\Http\Request;

class Spirit_orderController extends Controller
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

        $spirit_Order = Spirit_order::create([
            'quantify' => $request->quantify,
            'price' => $request->quantify * $request->priceSpirit,
            'spirit_id' => $request->id,
            'order_id' => $request->idOrder,
        ]);
        if ($spirit_Order->save()) {
            return redirect()->route('menu-restaurant')
                ->with('message', 'Bebida agregado a la orden correctamente')
                ->with('spiritOrder', $spirit_Order->id);
        }
    }
}
