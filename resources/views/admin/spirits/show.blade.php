@extends('adminlte::page')

@section('title', 'licor')

@section('content')

<div class="container-fluid w-auto">
    <div class="row">
        <h1 class="my-lg-2 my-2">MOSTRAR LICORES</h1>
        {{-- <table class="table table-flush" id="datatable-buttons"> --}}
            <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" theme="light" :config='$config'
                with-buttons with-footer>
                @foreach($spirits as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    <td>
                        <img src="{!! asset('files/spirits/'.$row->image) !!}" alt="imagen-licor" class=" w-50">
                    </td>
                    <td>{!! $row->stock !!} uds.</td>
                    <td>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fas fa-wine-bottle"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fas fa-glass-martini-alt"></i>
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