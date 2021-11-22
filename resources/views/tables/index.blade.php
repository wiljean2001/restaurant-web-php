@extends('adminlte::page')

@section('title', 'Mesa')

@section('content')
<div class="d-flex flex-row w-100 flex-wrap">
    <div class="w-50">
        <h1 class="my-lg-2 mt-3 mt-lg-3">REGISTRAR MESA</h1>
        <form action=" {{ route('table.create') }}" method="POST" class="d-flex flex-column"
            enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" id="id" hidden>
            <div class="col-md-auto">
                <label for="name">Ingresar mesa</label>
                <div class="form-group">
                    <input type="text" class="form-control focused w-100" placeholder="Arroz con pollo" name="num_table"
                        required id="name">
                </div>
            </div>
            <div class="col-md-auto text-center mt-4 mt-lg-4">
                <input type="submit" class="btn bg-gradient-purple w-75 py-2 py-lg-2" name="register"
                    value="REGISTRAR MESA">
            </div>
        </form>
    </div>
    <div class="p-2 p-lg-2 table-responsive w-50">
        <x-adminlte-datatable id="table3" :heads="$heads" head-theme="dark" :config='$config' with-buttons with-footer>
            @foreach($tables as $row)
            <tr>
                <td>{!! $row->id !!}</td>
                <td>{!! $row->num_table !!}</td>
                <td>
                    <div>
                        <x-adminlte-button label="Editar" theme="warning" icon="fas fa-pen-square" id="btn-edit" />
                        <x-adminlte-button label="Eliminar" theme="warning" icon="fas fa-pen-square" id="btn-delete" />
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
    $('#table3').on('click', '#btn-edit', function (e) {
        var table = $('#table3').DataTable();
        e.preventDefault();
        var row = $(this).parent().parent().parent()[0];
        var data = table.row(row).data();
        var price = parseFloat(data[2], 10);
        $('#id').val(data[0]);
        $('#num_table').val(data[1]);
        // console.log(data);
});
</script>
@endpush

