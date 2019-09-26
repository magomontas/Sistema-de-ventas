@extends('layouts.admin')

@section('contenido')
    <style>
        .img-thumbnail{
            height: 80px !important;
            width: 60px;
        }
        li{
            color: red;
        }
        .fa-check-circle{
            color: #00e765;
        }
    </style>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de articulos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('almacen.articulo.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($articulos as $art)
                <tr>
                    <td>{{ $art->idarticulo }}</td>
                    <td>{{ $art->nombre }}</td>
                    <td>{{ $art->codigo }}</td>
                    <td>{{ $art->categoria }}</td>
                    <td>{{ $art->stock }}</td>
                    <td>
                        <img src="{{ asset('images/articulos/'.$art->imagen) }}" alt="No hay img que mostrar" height="80px" width="80px" class="img-thumbnail">
                    </td>
                    @if($art->estado != "Activo")
                        <td><li class="fas fa-exclamation-triangle">{{ $art->estado }}</li></td>
                    @elseif($art->estado == "Activo")
                        <td><li class="far fa-check-circle">{{ $art->estado }}</li></td>

                    @endif
                    <td>
                        <a href="{{ URL::action('ArticuloController@edit',$art->idarticulo) }}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{ $art->idarticulo }}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        <a href="{{ URL::action('ArticuloController@detail',$art->idarticulo) }}"><button class="btn btn-success">Imprimir</button></a>
                    </td>
                </tr>
                @include('almacen.articulo.modal')
                @endforeach
            </table>
        </div>
        {{ $articulos->render() }}
    </div>
</div>
@endsection
