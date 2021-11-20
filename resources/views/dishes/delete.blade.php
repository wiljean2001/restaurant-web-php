@extends('adminlte::page')

@section('title', 'Plato')
@section('css')
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
@stop
@section('content')

<div class="container-fluid w-auto">
    <form action="{{ route('dish.distroy') }}" method="POST" id="form-delete">
        @csrf
        @method('POST')
        <div class="row  pb-4 mb-pg-4">
            <h1 class="my-lg-2">ELIMINAR PLATOS</h1>
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
                    <td>
                        <input type="checkbox" name="idDel[]" class="checkbox" value="{!! $row->id !!}">
                    </td>
                </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
        <div class="btn-flotante d-flex flex-row">
            <x-adminlte-button class="" type="reset" label="Resetear" theme="outline-danger"
                icon="fas fa-lg fa-trash" />
            <x-adminlte-button class="ml-3 ml-lg-3" type="submit" label="Eliminar" theme="outline-danger" name="submit"
                icon="far fa-trash-alt" />
        </div>
    </form>
</div>
@endsection
@extends('layouts.footers.footer')
{{--
@section('js')
<script>
    $("#form-delete").submit();
    $(document).ready(function() {
        $("#form-delete").submit(function( event ) {
            event.preventDefault();
            Swal.fire({
                title: 'Desea eliminar los productos?',
                text: "Se elminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.currentTarget.submit();
                }
            });
        });
    });
</script>
@endsection --}}