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

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $tables = Table::all();
        $dishes = Dish::paginate(6);
        $drinks = Drink::paginate(6);
        $spirits = Spirit::paginate(6);
        // Name end-order -> finaliza la orden
        if ($request->endOrder) {
            // Vuelve a la tabla al estado disponible
            Table::where('id', $request->session()->get('tableID'))
                ->update([
                    'state' => false
                ]);
            // alerta al mesero que se finalizo una orden.
            $request->session()->forget('orderId');
            $request->session()->forget('tableID');
            back()->with('message-order', 'Orden realizada exitosamente!.');
            return view('orders.index', compact('dishes', 'drinks', 'spirits', 'tables'));
        }


        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        back()->with('dishOrder', $request->session()->has('dishOrder'));
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
        $orders->table_id = $request->idTable;

        if ($orders->save()) {
            back()->with('message-order', 'Orden generada exitosamente!.');
        } else {
            back()->with('error-order', 'No se pudo generar orden.');
        }
        return redirect()->route('menu-restaurant')
            ->with('orderId', '' . $orders->id)
            ->with('tableID', $request->idTable);
    }
    // , $idTable
    public function show(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            return redirect()->route('menu-restaurant')
                ->with('error-order', 'Por favor genere una orden.');
        }
        // Obtenemos la cabecera y la configuracion de la tabla
        $heads = $this->getHeads();
        $config = $this->getConfig();
        // Inicializar variabels
        $Order = [];
        $dishes = [];
        $drinks = [];
        $spirits = [];

        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));

        // Eloquent: Relationships 
        $dishes_o = Order::with('dish_Orders.dishes')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        // print_r($dishes->dish_orders->dishes);

        $drinks_o = Order::with('drink_Orders.drinks')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $spirits_o = Order::with('spirit_Orders.spirits')
            ->where('table_id', $request->session()->get('tableID'))
            ->where('id', $request->session()->get('orderId'))->get();

        $table = Table::where('id', $request->session()->get('tableID'))->get();
        printf($dishes_o);
        dd($dishes_o);

        // printf($dishes);
        // foreach ($dishes as $dish) {
        //     foreach ($dish->dish_Orders as $dish_o) {
        //         foreach ($dish_o->image as $dish_o) {
        //         }
        //     }
        // }
        // printf($dishes_o);

        //  METODO DE JOINS
        // $dishes = Dish::select(
        //     'dishes.id',
        //     'dishes.name',
        //     'dishes.price',
        //     'dishes.description',
        //     'dish_orders.quantify',
        //     'tables.num_table',
        //     'dish_orders.price as total'
        // )
        //     ->join('dish_orders', 'dishes.id', '=', 'dish_orders.dish_id')
        //     ->join('orders', 'dish_orders.order_id', '=', 'orders.id')
        //     ->join('tables', 'orders.table_id', '=', 'tables.id')
        //     ->where('tables.id', '=', $request->session()->get('tableID'))
        //     ->where('orders.id', '=', $request->session()->get('orderId'))
        //     ->get();;

        // $drinks = Drink::select(
        //     'drinks.id',
        //     'drinks.name',
        //     'drinks.price',
        //     'drinks.description',
        //     'drink_orders.quantify',
        //     'tables.num_table',
        //     'drink_orders.price as total'
        // )
        //     ->join('drink_orders', 'drinks.id', '=', 'drink_orders.drink_id')
        //     ->join('orders', 'drink_orders.order_id', '=', 'orders.id')
        //     ->join('tables', 'orders.table_id', '=', 'tables.id')
        //     ->where('tables.id', '=', $request->session()->get('tableID'))
        //     ->where('orders.id', '=', $request->session()->get('orderId'))
        //     ->get();;
        // $spirits = Spirit::select(
        //     'spirits.id',
        //     'spirits.name',
        //     'spirits.price',
        //     'spirits.description',
        //     'spirit_orders.quantify',
        //     'tables.num_table',
        //     'spirit_orders.price as total'
        // )
        //     ->join('spirit_orders', 'spirits.id', '=', 'spirit_orders.spirit_id')
        //     ->join('orders', 'spirit_orders.order_id', '=', 'orders.id')
        //     ->join('tables', 'orders.table_id', '=', 'tables.id')
        //     ->where('tables.id', '=', $request->session()->get('tableID'))
        //     ->where('orders.id', '=', $request->session()->get('orderId'))
        //     ->get();


        return view('orders.show', compact('dishes', 'drinks', 'spirits', 'heads', 'config'));
        //  'drinks', 'spirits'
        // return view('orders.show', compact(
        //     'drinks_o',
        //     'spirits_o',
        //     'dishes_o',
        //     'table',
        //     'heads',
        //     'config'
        // ));
    }
    public function edit(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            back()->with('error-order', 'Por favor genere una orden.');
            return redirect()->route('menu-restaurant');
        }
        $Order = null;
        $heads = $this->getHeads();
        $config = $this->getConfig();
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        $dishes = [];
        $spirits = [];
        $drinks = [];
        return view('orders.update', compact('Order', 'dishes', 'heads', 'config'));
    }

    public function update(Request $request)
    {
    }

    public function destroy(Request $request)
    {
    }

    public function delete(Request $request)
    {
        if (!$request->session()->has('tableID') && !$request->session()->has('orderId')) {
            back()->with('error-order', 'Por favor genere una orden.');
            return redirect()->route('menu-restaurant');
        }
        $Order = null;
        $heads = $this->getHeads();
        $config = $this->getConfig();
        back()->with('orderId', $request->session()->get('orderId'));
        back()->with('tableID', $request->session()->get('tableID'));
        $dishes = [];
        $spirits = [];
        $drinks = [];
        return view('orders.delete', compact('Order', 'dishes', 'heads', 'config'));
    }

    private function getHeads()
    {
        return $heads = [
            ['label' => 'ID', 'width' => 0],
            'Nombre',
            'Precio unit.',
            ['label' => 'Descripcion', 'width' => 40],
            ['label' => 'Cantidad', 'width' => 10],
            ['label' => 'Mesa', 'width' => 3],
            ['label' => 'Precio Total', 'width' => 0],
            ['label' => 'Accion', 'width' => 0],
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
                null,
                //     ->join('tables', 'orders.tableID', '=', 'tables.id')
                null,
                null,
                ['orderable' => false]
            ],
        ];
    }
}
// Metodo de relaciones con Joins 
// select d.id, d.name, d.price, d.description, d.image, dio.quantify, t.num_table from dishes d 
// inner join dish_orders dio ON d.id = dio.dishID
// inner join orders o ON o.id = dio.orderID
// inner join tables t ON t.id = o.tableID
// where t.id = 1;
// dd($Order);
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
