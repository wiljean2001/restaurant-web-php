@extends('adminlte::page')

@section('title', 'Plato')

@section('content')

<div class="container-fluid w-auto">
    <div class="row">
        <h1 class="my-lg-2 my-2">MOSTRAR PLATOS</h1>
        {{-- <table class="table table-flush" id="datatable-buttons"> --}}
            <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config='$config' with-buttons
                with-footer>
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
                    <td><a href="">h</a></td>
                </tr>
                @endforeach
            </x-adminlte-datatable>
    </div>
</div>
@stop
@extends('layouts.footers.footer')


@section('js')
@stop