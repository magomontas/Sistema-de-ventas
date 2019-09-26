@extends('layouts.admin')

@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Artículo: {{ $articulo->nombre }}</h3>
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


{!! Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idarticulo],'files'=>'true']) !!}
{{Form::token()}}
<div class="row">
{{--    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">--}}
{{--        <div class="form-group">--}}
{{--            <label for="nombre">Nombre</label>--}}
{{--            <input type="text" name="nombre" required value="{{ $articulo->nombre }}" class="form-control">--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="text-right">Codigo</th>
                <th class="text-right">Stock</th>
                <th class="text-right">Descripcion</th>
                <th class="text-right">Imagen</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-right">{{ $articulo->codigo  }}</td>
                <td class="text-right">{{ $articulo->stock  }}</td>
                <td class="text-right">{{ $articulo->descripcion  }}</td>
                <td class="text-right">{{ $articulo->imagen  }}</td>
            </tr>
            </tbody>
        </table>
</div>

{!! Form::close() !!}


@endsection
