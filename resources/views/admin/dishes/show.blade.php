@extends('adminlte::page')

@section('title', 'Plato')

@section('content')

<div class="container-fluid w-auto">
    <div class="row">
        <h1 class="my-lg-2 my-2">MOSTRAR PLATOS</h1>
        <x-adminlte-datatable id="table1" :heads="$heads" theme="light" head-theme="dark" :config='$config' with-buttons
            with-footer hoverable>
            @foreach($dishes as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->name !!}</td>
                <td>S/ {!! $row->price !!}</td>
                <td>{!! $row->description !!}</td>
                <td>
                    <img src="{!! asset('files/dishes/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                </td>
                <td>{!! $row->stock !!} uds.</td>
                <td>
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fas fa-utensils"></i>
                    </button>
                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                        <i class="fas fa-drumstick-bite"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>
@stop
@extends('layouts.footers.footer')


@section('js')
@stop