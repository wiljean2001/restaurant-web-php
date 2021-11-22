<?php

namespace App\Http\Controllers;
use App\Models\Spirit;
use Illuminate\Http\Request;

class SpiritController extends Controller
{
    public function index()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $spirits = Spirit::all();
        return view('spirits.show', compact('heads', 'spirits', 'config'));
    }

    public function create()
    {
        $time = date('m-d-Y h:i:s a');
        // back()->with('error', '');
        // back()->with('message', '');
        return view('spirits.add', compact('time'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'stock' => 'required'
        ]);

        $spiritObj = new Spirit();
        $spiritObj->name = $request->name;
        $spiritObj->description = $request->description;
        $spiritObj->price = $request->price;
        $spiritObj->stock = $request->stock;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/files/drinks/', $filename);
            $spiritObj->image = $filename;
        }

        if ($spiritObj->save()) {
            back()->with('message', 'true');
        } else {
            back()->with('error', 'true');
        }

        return redirect()->route('Spirit.create', $spiritObj); 
        }  
        
        public function show(Spirit $drinks)
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        return view('Spirits.delete', compact('heads', 'Spirits', 'config'));
    }

    public function edit()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $spirits = Spirit::all();
        return view('Spirits.update', compact('heads', 'Spirits', 'config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        if ($request->image) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/files/Spirits/', $filename);
            }
            Spirit::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'image' => $filename,
                    'price' => $request->price
                ]);
        } else {
            Spirit::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'price' => $request->price
                ]);
        }
        return $this->edit();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'idDel' => 'required',
        ]);
        foreach ($request->idDel as $dish) {
            Spirit::where('id', '=', $dish)->delete();
        }
        return redirect()->route('spirit.delete');
    }

    public function delete()
    {
        $heads = $this->getHeads();
        $config = $this->getConfig();
        $spirits = Spirit::all();
        return view('spirits.delete', compact('heads', 'spirits', 'config'));
    }

    private function getHeads()
    {
        return $heads = [
            ['label' => 'id', 'width' => 0],
            'Nombre',
            'Precio',
            ['label' => 'Descripcion', 'width' => 40],
            ['label' => 'Imagen', 'no-export' => true, 'width' => 13],
            ['label' => 'Stock', 'width' => 10],
            ['label' => 'Accion', 'no-export' => true, 'width' => 3],
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
                ['orderable' => false]
            ],
        ];
    }

}
