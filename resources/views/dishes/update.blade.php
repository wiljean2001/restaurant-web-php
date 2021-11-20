@extends('adminlte::page')

@section('title', 'Pllato')

@section('content')
<div class="d-flex flex-row w-100 flex-wrap">
    <div class="w-50">
        <h1 class="my-lg-2 mt-3 mt-lg-3">ACTUALIZAR PLATO</h1>
        <form action=" {{ route('dish.store') }}" method="POST" class="d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
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
                    <input type="number" class="form-control" placeholder="18.50" name="price" required id="price">
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
                    <div class="custom-file">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="image"
                                accept="image/*">
                            <label class="custom-file-label" for="customFileLang">Seleccionar imagen</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 mb-lg-4">
                <div class="col-md-8 mt-4 mt-lg-4 px-5 px-lg-5">
                    <input type="submit" class="btn btn-primary w-100 py-2 py-lg-2" name="register"
                        value="ACTUALIZAR PLATO">
                </div>
            </div>
        </form>
    </div>
    <div class="p-2 p-lg-2 table-responsive w-50">
        <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config='$config' with-buttons with-footer
            hoverable>
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
                    <img src="{!! asset('files/dishes/'.$row->image) !!}" alt="imagen-plato" class=" w-50">
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
@stop
@extends('layouts.footers.footer')


@push('js')
<script>
    $('#table2').on('click', '#btn-edit', function (e) {
        var table = $('#table2').DataTable();
        e.preventDefault();
        var row = $(this).parent().parent().parent()[0];
        var data = table.row(row).data();
        $('#id').val(data[0]);
        $('#name').val(data[1]);
        $('#price').val(parseFloat(data[2], 10));
        $('#descript').val(data[3]);
        $('#stock').val(parseFloat(data[5], 10));
        console.log(data);
});
</script>
@endpush