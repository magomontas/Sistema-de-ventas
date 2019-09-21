@extends('layouts.admin')

@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
    <h3>Editar Categoria: {{ $categoria->nombre }}</h3>
    @if (count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {!! Form::model($categoria,['method'=>'PUT','route'=>['categoria.update',$categoria->idcategoria]]) !!}
    {{Form::token()}}
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" placeholder="Nombre de categoria">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" class="form-control" value="{{ $categoria->descripcion }}" placeholder="Decripción de categoria">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn btn-danger" type="reset">Cancelar</button>
    </div>
    {!! Form::close() !!}

</div>
@endsection