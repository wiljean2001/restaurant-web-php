<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $tables = Table::all();
        return view("tables.index", compact('heads','tables','config'));
    }
    public function update()
    {
    }
    public function create()
    {
        # code...
    }
    private function getHeads()
    {
        return $heads = [
            ['label' => 'id', 'width' => 0],
            'Nombre de tabla',
            ['label' => 'Accion', 'no-export' => true, 'width' => 3]

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
                ['ordenable'=>false]           
            ],
        ];
    }
}
