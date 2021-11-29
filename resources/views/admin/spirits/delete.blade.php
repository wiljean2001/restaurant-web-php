@extends('adminlte::page')

@section('title', 'licor')
@section('content')

<div class="container-fluid w-auto">
    <form action="{{ route('spirit.distroy') }}" method="POST" id="form-delete">
        @csrf
        @method('POST')
        <div class="row  pb-4 mb-pg-4">
            <h1 class="my-lg-2">ELIMINAR LICORES</h1>
            <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config='$config' with-buttons
                with-footer>
                @foreach($spirits as $row)
                <tr>
                    <td>{!! $row->id !!}</td>
                    <td>{!! $row->name !!}</td>
                    <td>S/ {!! $row->price !!}</td>
                    <td>{!! $row->description !!}</td>
                    <td>
                        @if ($row->image)
                        <img src="{!! asset('storage/' . $row->image->url) !!}" alt="imagen-plato" class=" w-50">
                        @else
                        <img src="{!! asset('img/spirits.png') !!}" alt="imagen-plato" class=" w-50">
                        @endif
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

@if (Session::has('message'))
<div aria-live="polite" aria-atomic="true"
    class="d-flex justify-content-end align-items-center w-100 mb-5 mb-lg-5 btn-flotante">
    <!-- Then put toasts within -->
    <div id="toast1" class="toast bg-green" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <i class="far fa-check-circle green"></i>
            <strong class="mr-auto ml-1">Finalizado</strong>
            <small>{{ date('m-d-Y h:i:s a') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('message') }}
            Eliminación realizado exitosamente!.
        </div>
    </div>
</div>
@endif

@if (Session::has('error'))
<div aria-live="polite" aria-atomic="true"
    class="d-flex justify-content-end align-items-center w-100 mb-5 mb-lg-5 btn-flotante">
    <!-- Then put toasts within -->
    <div id="toast1" class="toast bg-red" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header ">
            <i class="fas fa-exclamation-triangle"></i>
            {{-- <img src="{{ asset('favicon/dishx24.png') }}" class="rounded me-2" alt="icono-dish"> --}}
            <strong class="mr-auto ml-1">Error</strong>
            <small>{{ date('m-d-Y h:i:s a') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('error') }}
        </div>
    </div>
</div>
@endif

@endsection
@extends('layouts.footers.footer')
{{--
@section('js')
<script>
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
                    $(this).submit();
                }
            });
        });
    });
</script>
@endsection --}}