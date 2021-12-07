@extends('adminlte::page')
@section('title', 'bebida')

@section('content')
<div class="d-flex flex-row w-100">
    <div class="w-100">
        <h1 class="my-lg-2 mt-3 mt-lg-3">AGREGAR BEBIDA</h1>
        <form action=" {{ route('drink.store') }}" method="POST" class="d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-8">
                <label for="name">Ingresar bebida</label>
                <div class="form-group">
                    <input type="text" class="form-control focused w-100" placeholder="Refresco de maracuya" name="name"
                        required>
                </div>
            </div>
            <div class="col-md-8">
                <label for="description">Ingresar descripción</label>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Jarra de 1lt de maracuya" name="description"
                        required></textarea>
                </div>
            </div>
            <div class="col-md-8">
                <label for="price">Ingresar precio</label>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="18.50" name="price" required step="0.01">
                </div>
            </div>
            <div class="col-md-8">
                <label for="price">Ingresar stock ud.</label>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="100" name="stock" required>
                </div>
            </div>
            <div class="col-md-8">
                <label for="image">Ingresar imagen</label>
                <div class="form-group">
                    <x-adminlte-input-file id="customFileLang" name="image" lang="es"
                        placeholder="Seleccionar imagen..." igroup-size="lg" legend="Choose" required accept="image/*">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </div>
            <div class="mb-4 mb-lg-4 text-center">
                <div class="col-md-8 mt-4 mt-lg-4 px-5 px-lg-5">
                    <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                        value="REGISTRAR BEBIDA">
                </div>
            </div>
        </form>
    </div>
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
@extends('layouts.footers.footer')
@stop


@section('js')
<script>
    $(document).ready(function(){
        $('.toast').toast('show');
    });
</script>
@stop