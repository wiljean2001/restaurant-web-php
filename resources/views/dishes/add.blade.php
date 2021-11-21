@extends('adminlte::page')
@section('title', 'Plato')

@section('content')
<div class="d-flex flex-row w-100">
    <div class="w-100">
        <h1 class="my-lg-2 mt-3 mt-lg-3">AGREGAR PLATO</h1>
        <form action=" {{ route('dish.store') }}" method="POST" class="d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-8">
                <label for="name">Ingresar plato</label>
                <div class="form-group">
                    <input type="text" class="form-control focused w-100" placeholder="Arroz con pollo" name="name"
                        required>
                </div>
            </div>
            <div class="col-md-8">
                <label for="description">Ingresar descripción</label>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Plato de arroz con pollo" name="description"
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
                    <div class="custom-file">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="image"
                                required accept="image/*">
                            <label class="custom-file-label" for="customFileLang">Seleccionar imagen</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 mb-lg-4 text-center">
                <div class="col-md-8 mt-4 mt-lg-4 px-5 px-lg-5">
                    <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                        value="REGISTRAR PLATO">
                </div>
            </div>
        </form>
    </div>
</div>
@if (Session::has('message'))

<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center w-100 mb-5 mb-lg-5">
    <!-- Then put toasts within -->
    <div id="toast1" class="toast bg-green" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <i class="far fa-check-circle green"></i>
            <strong class="mr-auto ml-1">Finalizado</strong>
            <small>{{ $time }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Registro realizado exitosamente!.
        </div>
    </div>
</div>
@endif
@if (Session::has('error'))

<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center w-100 mb-5 mb-lg-5">
    <!-- Then put toasts within -->
    <div id="toast1" class="toast bg-red" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header ">
            <i class="fas fa-exclamation-triangle"></i>
            {{-- <img src="{{ asset('favicon/dishx24.png') }}" class="rounded me-2" alt="icono-dish"> --}}
            <strong class="mr-auto ml-1">Error</strong>
            <small>{{ $time }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            No se pudo realizar el registro
        </div>
    </div>
</div>
@endif
@stop
@extends('layouts.footers.footer')

@section('js')
<script>
    $(document).ready(function(){
        $('.toast').toast('show');
    });
</script>
@stop