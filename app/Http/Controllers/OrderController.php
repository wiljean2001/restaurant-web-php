<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Drink;
use App\Models\Order;
use App\Models\Spirit;
use App\Models\Table;
use App\Models\Dish_order;
use App\Models\Drink_order;
use App\Models\Spirit_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        back()->with('orderId', '' . $request->session()->get('orderId'));
        back()->with('tableID', '' . $request->session()->get('tableID'));
        $tables = Table::all();
        $dishes = Dish::paginate(6);
        $drinks = Drink::paginate(6);
        $spirits = Spirit::paginate(6);
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
            back()->with('message-order', 'true');
        } else {
            back()->with('error-order', 'true');
        }
        return redirect()->route('menu-restaurant')
            ->with('orderId', '' . $orders->id)
            ->with('tableID', $request->idTable);
    }
    public function show(Request $request, $idTable)
    {
        // select d.id, d.name, d.price, d.description, d.image, dio.quantify, t.num_table from dishes d 
        // inner join dish_orders dio ON d.id = dio.dishID
        // inner join orders o ON o.id = dio.orderID
        // inner join tables t ON t.id = o.tableID
        // where t.id = 1;
        $heads = $this->getHeads();
        $config = $this->getConfig();
        back()->with('orderId', '' . $request->session()->get('orderId'));
        back()->with('tableID', '' . $request->session()->get('tableID'));
        $dishes = [];
        $spirits = [];
        $drinks = [];
        if ($request->session()->get('tableID') == $idTable) {
            // $Order = Order::where('id', '=', $request->session()->get('orderId'))->get();
            // $dishes = $Order->dish_Orders()->get();
            $Order = Order::all();
            $Order = Order::where('id', $request->session()->get('orderId'))->get();
            dd($Order);
            // where('id', '=', $request->session()->get('orderId'))
            // ->get()->tables()->where('tables.id', '=', $request->session()->get('tableID'));
            // $dishes = Dish::select(
            //     'dishes.id',
            //     'dishes.name',
            //     'dishes.price',
            //     'dishes.description',
            //     'dishes.image',
            //     'dish_orders.quantify',
            //     'tables.num_table',
            //     'dish_orders.price as total'
            // )
            //     ->join('dish_orders', 'dishes.id', '=', 'dish_orders.dishID')
            //     ->join('orders', 'dish_orders.orderID', '=', 'orders.id')
            //     ->join('tables', 'orders.tableID', '=', 'tables.id')

            // $drinks = Drink::select(
            //     'drinks.id',
            //     'drinks.name',
            //     'drinks.price',
            //     'drinks.description',
            //     'drinks.image',
            //     'drink_orders.quantify',
            //     'tables.num_table',
            //     'drink_orders.price as total'
            // )
            //     ->join('drink_orders', 'drinks.id', '=', 'drink_orders.drinkID')
            //     ->join('orders', 'drink_orders.orderID', '=', 'orders.id')
            //     ->join('tables', 'orders.tableID', '=', 'tables.id')
            //     ->where('tables.id', '=', $request->session()->get('tableID'))
            //     ->where('orders.id', '=', $request->session()->get('orderId'))
            //     ->get();
            // $spirits = Spirit::select(
            //     'spirits.id',
            //     'spirits.name',
            //     'spirits.price',
            //     'spirits.description',
            //     'spirits.image',
            //     'spirit_orders.quantify',
            //     'tables.num_table',
            //     'spirit_orders.price as total'
            // )
            //     ->join('spirit_orders', 'spirits.id', '=', 'spirit_orders.spiritID')
            //     ->join('orders', 'spirit_orders.orderID', '=', 'orders.id')
            //     ->join('tables', 'orders.tableID', '=', 'tables.id')
            //     ->where('tables.id', '=', $request->session()->get('tableID'))
            //     ->where('orders.id', '=', $request->session()->get('orderId'))
            //     ->get();
            // print_r($dishes);
            // printf($dishes); pruebas
        }
        //  'drinks', 'spirits'
        return view('orders.show', compact('Order', 'dishes', 'heads', 'config'));
    }

    private function getHeads()
    {
        return $heads = [
            ['label' => 'ID', 'width' => 0],
            'Nombre',
            'Precio unit.',
            ['label' => 'Descripcion', 'width' => 40],
            ['label' => 'Imagen', 'no-export' => true, 'width' => 13],
            ['label' => 'Cantidad', 'width' => 10],
            ['label' => 'Mesa', 'width' => 3],
            ['label' => 'Precio Total', 'width' => 0],
        ];
    }
    private function getConfig()
    {
        return $config = [
            "lengthMenu" => [
                [10, 25, 50, -1],
                ['10 Resultados', '25 Resultados', '50 Resultados', 'Motrar Todos'],
            ],
            "language" => [
                // "pageLength" => "Mostrar %d Registros",
                "lengthMenu" => "Ver _MENU_",
                "search" => "Buscar",
                "zeroRecords" => "Sin resultados",
                "info" => "Página _PAGE_ de _PAGES_",
                "infoEmpty" => "No hay registros disponibles",
                "infoFiltered" => "(filtrado de _MAX_ registros totales)",
                "paginate" => [
                    "previous" => '<i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>',
                    "next" => '<i class="fa fa-angle-right"></i><span class="sr-only">Next</span>',
                ],
            ],
            'columns' => [
                null,
                null,
                null,
                null,
                ['orderable' => false],
                null,
                null,
                null
            ],
        ];
    }
}
