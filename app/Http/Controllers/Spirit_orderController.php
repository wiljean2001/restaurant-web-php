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

        back()->with('tableID', '' . $request->session()->get('tableID'));
        back()->with('orderId', '' . $request->session()->get('orderId'));
        $spirit_Order = new Spirit_order();
        $spirit_Order->quantify = $request->quantify;
        $spirit_Order->price = $request->quantify * $request->priceSpirit;
        $spirit_Order->spirit_id = $request->id;
        $spirit_Order->order_id = $request->idOrder;
        if ($spirit_Order->save()) {
            back()->with('message', 'Licor agregado al pedido correctamente');
            return redirect()->route('menu-restaurant');
        }
    }
}
