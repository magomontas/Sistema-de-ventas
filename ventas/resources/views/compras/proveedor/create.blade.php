@extends('layouts.admin')

@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nuevo Proveedor</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
</div>

{!! Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off')) !!}
{{Form::token()}}

<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required value="{{ old('nombre') }}" class="form-control" placeholder="Nombre del proveedor">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_documento">Tipo de documento</label>
            <select name="tipo_documento" id="tipo_documento" class="form-control">
                <option value="DUI">DUI</option>
                <option value="NIT">NIT</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="num_documento">Numero de documento</label>
            <input type="text" name="num_documento" required value="{{ old('num_documento') }}" class="form-control" placeholder="Numero de documento">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" required value="{{ old('telefono') }}" class="form-control" placeholder="Teléfono">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" required value="{{ old('email') }}" class="form-control" placeholder="Correo electrónico">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </div>
</div>


{!! Form::close() !!}
@endsection