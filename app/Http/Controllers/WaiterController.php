<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waiters = Waiter::all();
        $config = $this->getConfig();
        $heads = $this->getHeads();
        $configTable = $this->getConfigTable();
        // dd($config);
        return view('admin.waiters.index', compact(
            'waiters',
            'config',
            'heads',
            'configTable'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_of_birth' => 'required',
            'name' => 'required',
            'lname' => 'required',
            'dni' => 'required',
        ]);
        $waiter = Waiter::create([
            'date_of_birth' => $request->date_of_birth,
            'name' => $request->name,
            'lname' => $request->lname,
            'dni' => $request->dni,
        ]);
        if ($waiter->save()) {
            back()->with('message', 'Registro realizado exitosamente');
        } else {
            back()->with('error', 'Error al registrar el mozo');
        }
        return redirect()->route('waiter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id' => 'required',
            'lname' => 'required',
            'date_of_birth' => 'required',
        ]);
        $waiter = Waiter::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'lname' => $request->lname,
                'date_of_birth' => $request->date_of_birth,
            ]);
        if ($waiter) {
            back()->with('message', 'Actualizacion realizada exitosamente');
        } else {
            back()->with('error', 'Error al actualizar al mozo');
        }
        return redirect()->route('waiter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $waiter = Waiter::where('id', $request->id)->delete();
        if ($waiter) {
            back()->with('message', 'Eliminación realizada exitosamente');
        } else {
            back()->with('error', 'Error al eliminar al mozo');
        }
        return redirect()->route('waiter.index');
    }
    public function getConfig()
    {
        // format ... HH.mm
        return $config = [
            'format' => 'YYYY-MM-DD',
            'dayViewHeaderFormat' => 'MMM YYYY',
            // 'minDate' => "js:moment().startOf('month')",
            'maxDate' => "js:moment().endOf('month')",
            // 'daysOfWeekDisabled' => [0, 6],
        ];
    }
    private function getHeads()
    {
        return $heads = [
            ['label' => 'N°', 'width' => 0],
            ['label' => 'DNI', 'width' => 15],
            ['label' => 'Nombre', 'width' => 20],
            ['label' => 'Apellidos', 'width' => 20],
            ['label' => 'Fecha de nacimiento', 'width' => 15],
            ['label' => 'Acciones', 'width' => 100],
        ];
    }
    private function getConfigTable()
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
                null,
            ],
        ];
    }
}
