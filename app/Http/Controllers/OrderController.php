<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Drink;
use App\Models\Order;
use App\Models\Spirit;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        back()->with('orderId', '' . $request->session()->get('orderId'));
        $tables = Table::all();
        $dishes = DB::table('Dishes')
            ->select(['id', 'name', 'description', 'price', 'stock', 'image'])
            ->paginate(6);
        $drinks = DB::table('Drinks')
            ->select(['id', 'name', 'description', 'price', 'stock', 'image'])
            ->paginate(6);
        $spirits = DB::table('Spirits')
            ->select(['id', 'name', 'description', 'price', 'stock', 'image'])
            ->paginate(6);
        return view('orders.index', compact('dishes', 'drinks', 'spirits', 'tables'));
    }

    public function create(Request $request)
    {
        // return redirect()->route('menu-restaurant');
        Table::where('id', $request->idTable)
            ->update([
                'state' => true
            ]);
        // $table->state = true;
        $orders = new Order();
        $orders->date = date('Y-m-d h:i:s');
        $orders->tableID = $request->idTable;

        if ($orders->save()) {
            $this->idOrder = $orders->id;
        }
        return redirect()->route('menu-restaurant')->with('orderId', '' . $orders->id);
    }
}
