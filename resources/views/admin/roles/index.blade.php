@extends('adminlte::page')

@section('title', 'Roles')

@section('content')

<div class="container-fluid w-auto">
  <div class="row">
    <h1 class="my-lg-2 my-2">MOSTRAR ROLES</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Descripción</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($roles as $rol)
        <tr>
          <th scope="row">{!! $rol->id !!}</th>
          <td>{!! $rol->description !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
@extends('layouts.footers.footer')


@section('js')
@stop