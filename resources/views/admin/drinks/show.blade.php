@extends('adminlte::page')

@section('title', 'bebida')

@section('content')

<div class="container-fluid w-auto">
    <div class="row">
        <h1 class="my-lg-2 my-2">MOSTRAR BEBIDAS</h1>
        {{-- <table class="table table-flush" id="datatable-buttons"> --}}
            <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" theme="light" :config='$config' with-buttons
                with-footer>
                @foreach($drinks as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    <td>
                        <img src="{!! asset('files/drinks/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
                    </td>
                    <td>{!! $row->stock !!} uds.</td>
                    <td>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fas fa-mug-hot"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="far fa-lemon"></i>
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