@extends('layouts.admin')

@section('contenido')
    <style>
        .ac2{
        color: #00e765;
        }
        .ac1{
        color:red;
        }

    </style>

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <hr>
            <h3>Listado de ventas por dia, semana o mes. <br><a href="{{ URL::action('VentaController@totalVentas') }}"><button class="btn btn-warning btn-microsoft">Ver Listado</button></a></h3>
            @include('ventas.venta.search')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 class="text-center text-blue">Listado de ventas</h3>
               <h4 class="text-bold">Crear una nueva venta<a href="venta/create"><button class="btn btn-success">&nbsp Nuevo</button></a></h4>
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-condensed table-hover">
                    <thead>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Comprobante </th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($ventas as $ven)
                        <tr>
                            <td>{{ $ven->fecha_hora }}</td>
                            <td>{{ $ven->nombre }}</td>
                            <td>{{ $ven->tipo_comprobante .': '.$ven->serie_comprobante.'-'. $ven->num_comprobante }}</td>
                            <td>{{ $ven->impuesto }}</td>
                            <td>{{ $ven->total_venta }}</td>
                            @if($ven->estado !== "A")
                                <td class="ac1"><li class="fas fa-exclamation-triangle">{{ $ven->estado }}</li></td>
                            @else
                                <td class="ac2"><li class="far fa-check-circle">{{ $ven->estado }}</li></td>
                            @endif
                                <td>
                                <a href="{{ URL::action('VentaController@show',$ven->idventa) }}"><button class="btn btn-info">Ver Detalles</button></a>
                                <a href="" data-target="#modal-delete-{{ $ven->idventa }}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                            </td>
                        </tr>
                        @include('ventas.venta.modal')
                    @endforeach
                </table>
            </div>
            {{ $ventas->render() }}
        </div>
    </div>
@endsection
