@extends('adminlte::page')

@section('title', 'Plato')
@section('content')
<div class="d-flex flex-row w-100 flex-wrap">
    <div class="w-50">
        <h1 class="my-lg-2 mt-3 mt-lg-3">ACTUALIZAR PLATO</h1>
        <form action=" {{ route('dish.update') }}" method="POST" class="d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="id" id="id" hidden>
            <div class="col-md-auto">
                <label for="name">Ingresar plato</label>
                <div class="form-group">
                    <input type="text" class="form-control focused w-100" placeholder="Arroz con pollo" name="name"
                        required id="name">
                </div>
            </div>
            <div class="col-md-auto">
                <label for="description">Ingresar descripción</label>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Plato de arroz con pollo" name="description" required
                        id="descript"></textarea>
                </div>
            </div>
            <div class="col-md-auto">
                <label for="price">Ingresar precio</label>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="18.50" name="price" required id="price"
                        step="0.01">
                </div>
            </div>
            <div class="col-md-auto col-lg-auto">
                <label for="price">Ingresar stock ud.</label>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="100" name="stock" required id="stock">
                </div>
            </div>
            <div class="col-md-auto col-lg-auto">
                <label for="image">Ingresar imagen</label>
                <div class="form-group">
                    <x-adminlte-input-file id="customFileLang" name="image" lang="es"
                        placeholder="Seleccionar imagen..." igroup-size="lg" legend="Choose" accept="image/*">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </div>
            <div class="col-md-auto text-center mt-4 mt-lg-4">
                <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                    value="ACTUALIZAR PLATO">
            </div>
        </form>
    </div>
    <div class="p-2 p-lg-2 table-responsive w-50">
        <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config='$config' with-buttons with-footer
            hoverable compressed>
            @foreach($dishes as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->name !!}</td>
                <td class="d-flex flex-row-reverse">
                    {!! $row->price !!}
                    <div>S/</div>
                </td>
                <td>{!! $row->description !!}</td>
                <td>
                    @if ($row->image)
                    <img src="{!! asset('storage/' . $row->image->url) !!}" alt="imagen-plato" class=" w-50">
                    @else
                    <img src="{!! asset('img/dishes.png') !!}" alt="imagen-plato" class=" w-50">
                    @endif
                </td>
                <td>
                    {!! $row->stock !!}
                    <label for=""> uds.</label>
                    {{-- <div> uds.</div> --}}
                </td>
                <td>
                    <div>
                        <x-adminlte-button label="Editar" theme="warning" icon="fas fa-pen-square" id="btn-edit" />
                    </div>
                </td>
            </tr>
            @endforeach
        </x-adminlte-datatable>
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
            <small>{{ Time() }}</small>
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
            <small>{{ $time }}</small>
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

@push('js')
<script>
    $('#table2').on('click', '#btn-edit', function (e) {
        var table = $('#table2').DataTable();
        e.preventDefault();
        var row = $(this).parent().parent().parent()[0];
        var data = table.row(row).data();
        var price = parseFloat(data[2], 10);
        $('#id').val(data[0]);
        $('#name').val(data[1]);
        $('#price').val(price).text().replace(',', '.');
        $('#descript').val(data[3]);
        $('#stock').val(parseInt(data[5]));
        // console.log(data);
}); 
</script>
@endpush