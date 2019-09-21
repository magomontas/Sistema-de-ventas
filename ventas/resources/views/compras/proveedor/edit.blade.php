@extends('layouts.admin')

@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Proveedor: {{ $persona->nombre }}</h3>
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


{!! Form::model($persona,['method'=>'PATCH','route'=>['proveedor.update',$persona->idpersona], 'autocomplete'=>'off']) !!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required value="{{ $persona->nombre }}" class="form-control" placeholder="Nombre del cliente">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_documento">Tipo de documento</label>
            <select name="tipo_documento" id="tipo_documento" class="form-control">
                @if (($persona->tipo_documento)=='DUI')
                <option value="DUI" selected>DUI</option>
                <option value="NIT">NIT</option>
                @else
                <option value="DUI">DUI</option>
                <option value="NIT" selected>NIT</option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="num_documento">Numero de documento</label>
            <input type="text" name="num_documento" required value="{{ $persona->num_documento }}" class="form-control" placeholder="Numero de documento">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" required value="{{ $persona->telefono }}" class="form-control" placeholder="Teléfono">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" required value="{{ $persona->email }}" class="form-control" placeholder="Correo electrónico">
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