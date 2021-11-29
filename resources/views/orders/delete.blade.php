{{-- @extends('layouts.order') --}}
@extends('adminlte::page')
@section('title', 'Eliminar')

@section('content')

<div class="container">
    <h1 class="my-lg-2 my-2">ORDEN - ELIMINAR: </h1>
    <div class="mx-5 mx-lg-5">
        <x-adminlte-card title="PLASTOS" theme="maroon" theme-mode="full" icon="fas fa-lg fa-bell" collapsible
            maximizable>
            {{-- Dish Table --}}
            <x-adminlte-datatable id="table1" :heads="$heads" theme="" head-theme="dark" :config='$config' with-buttons
                with-footer hoverable>
                @if ($dishes==null)
                <tr>
                    <td rowspan="7">No hay platos solicitados</td>
                </tr>
                @else
                @foreach($dishes as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    <td>
                        <img src="{!! asset('files/dishes/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                    </td>
                    <td>{!! $row->quantify !!} uds.</td>
                    <td>Mesa {!! $row->num_table !!}</td>
                    <td>S/ {!! $row->total !!}</td>
                </tr>
                @endforeach
                @endif
            </x-adminlte-datatable>
        </x-adminlte-card>

        <x-adminlte-card title="BEBIDAS" theme="success" theme-mode="full" icon="fas fa-lg fa-bell" collapsible
            maximizable>
            {{-- Drink Table --}}
            <x-adminlte-datatable id="table2" :heads="$heads" theme="" head-theme="dark" :config='$config' with-buttons
                with-footer hoverable>
                @if ($drinks==null)
                <tr>
                    <td rowspan="7">No hay bebidas solicitados</td>
                </tr>
                @else
                @foreach($drinks as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    <td>
                        <img src="{!! asset('files/drinks/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                    </td>
                    <td>{!! $row->quantify !!} uds.</td>
                    <td>Mesa {!! $row->num_table !!}</td>
                    <td>S/ {!! $row->total !!}</td>
                </tr>
                @endforeach
                @endif
            </x-adminlte-datatable>
        </x-adminlte-card>

        <x-adminlte-card title="LICORES" theme="purple" theme-mode="full" icon="fas fa-lg fa-bell" collapsible
            maximizable>
            {{-- Spirit Table --}}
            <x-adminlte-datatable id="table3" :heads="$heads" theme="" head-theme="dark" :config='$config' with-buttons
                with-footer hoverable>
                @if ($spirits==null)
                <tr>
                    <td rowspan="7">No hay licores solicitados</td>
                </tr>
                @else
                @foreach($spirits as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    <td>
                        <img src="{!! asset('files/spirits/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                    </td>
                    <td>{!! $row->quantify !!} uds.</td>
                    <td>Mesa {!! $row->num_table !!}</td>
                    <td>S/ {!! $row->total !!}</td>
                </tr>
                @endforeach
                @endif
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
@stop