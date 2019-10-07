@extends('layouts.admin')

@section('contenido')
    <style>
    </style>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <button class="btn bg-green-gradient">Ventas por dia</button>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tota de ventas realizadas HOY!</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tipo de comprobante</th>
                            <th>Estado</th>
                            <th>Total de ventas diarias</th>
                        </tr>
                        @foreach($vDia as $ven)
                            <tr>
                                <td>{{ $ven->idventa }}.</td>
                                <td>{{ $ven->tipo_comprobante }}</td>
                                <td>
                                    @if($ven->estado=="A")
                                        <span class="badge bg-aqua-gradient">{{ $ven->estado }}</span>
                                    @else
                                        <span class="badge bg-red-gradient">{{ $ven->estado }}</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-blue-gradient"> ${{ $ven->total_venta }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <button class="btn btn-success">Ventas por mes</button>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tota de ventas realizadas este MES!</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tipo de comprobante</th>
                            <th>Estado</th>
                            <th>Total de ventas diarias</th>
                        </tr>
                        @foreach($vMes as $ven)
                            <tr>
                                <td>{{ $ven->idventa }}.</td>
                                <td>{{ $ven->tipo_comprobante }}</td>
                                <td>
                                    @if($ven->estado=="A")
                                        <span class="badge bg-aqua-gradient">{{ $ven->estado }}</span>
                                    @else
                                        <span class="badge bg-red-gradient">{{ $ven->estado }}</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-blue-gradient"> ${{ $ven->total_venta }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <button class="btn btn-success">Ventas por mes</button>
        </div>
    </div>
@endsection
