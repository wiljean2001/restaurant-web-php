<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Exception;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $tables = Table::all();
        return view("admin.tables.index", compact('heads', 'tables', 'config'));
    }

    public function create(Request $request)
    {
        $table = new Table();
        $table->num_table = $request->num_table;
        $table->state = false;
        if ($table->save()) {
            back()->with('message', 'Registro realizada exitosamente!.');
        } else {
            back()->with('error', 'Error de registro, si el error perdura por favor reportarlo.');
        }
        return redirect()->route('table.index');
    }

    public function update(Request $request)
    {
        try {
            Table::where('id', '=', $request->id)
                ->update(['num_table' => $request->nameTable]);
            back()->with('message', 'Actualizacion realizada exitosamente!.');
        } catch (Exception $exec) {
            back()->with('error', 'El nombre de la mesa ya existe, inserte un nuevo nombre.');
        }
        return redirect()->route('table.index');
    }

    public function delete(Request $request)
    {
        try {
            $result = Table::where('id', '=', $request->id)->delete();
            back()->with('message', 'Tabla eliminada exitosamente!.');
        } catch (Exception $exec) {
            back()->with('error', 'Error al eliminar la mesa. Mesa ocuapada por un proceso de orden, por favor espere que finalice dicho proceso');
        }

        return redirect()->route('table.index');
    }
    private function getHeads()
    {
        return $heads = [
            ['label' => 'id', 'width' => 0],
            ['label' => 'Nombre de tabla', 'width' => 05],
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
                "info" => "P??gina _PAGE_ de _PAGES_",
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
                ['orderable' => false]
            ],
        ];
    }
}
