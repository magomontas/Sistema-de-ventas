@extends('layouts.admin')

@section('contenido')
    <style>
        li{
            color: red;
        }
        .fa-check-circle{
            color: #00e765;
        }
    </style>

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de ingresos <a href="ingreso/create">
                    <button class="btn btn-success">Nuevo</button>
                </a></h3>
            @include('compras.ingreso.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-condensed table-hover">
                    <thead>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($ingresos as $ing)
                        <tr>
                            <td>{{ $ing->fecha_hora }}</td>
                            <td>{{ $ing->nombre }}</td>
                            <td>{{ $ing->tipo_comprobante .': '.$ing->serie_comprobante.'-'. $ing->num_comprobante }}</td>
                            <td>{{ $ing->impuesto }}</td>
                            <td>{{ $ing->total }}</td>
                            @if($ing->estado !="Activo")
                                <td><li class="fas fa-exclamation-triangle">{{ $ing->estado }}</li></td>
                            @elseif(($ing->estado =="Activo"))
                                <td><li class="far fa-check-circle">{{ $ing->estado }}</li></td>
                            @endif
                            <td>
                                <a href="{{ URL::action('IngresoController@show',$ing->idingreso) }}">
                                    <button class="btn btn-info">Ver Detalles</button>
                                </a>
                                @if($ing->estado=="Activo")
                                    <a href="" data-target="#modal-delete-{{ $ing->idingreso }}" data-toggle="modal">
                                        <button class="btn btn-danger" onclick="execute">Eliminar</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @include('compras.ingreso.modal')
                    @endforeach
                </table>
            </div>
            {{ $ingresos->render() }}
        </div>
    </div>
@endsection
