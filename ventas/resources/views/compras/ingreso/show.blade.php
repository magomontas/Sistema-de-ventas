@extends('layouts.admin')

@section('contenido')

<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <p>{{$ingresos->nombre}}</p>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
        <div class="form-group">
            <label for="tipo_comprobante">Tipo de Comprobante</label>
            <p>{{$ingresos->tipo_comprobante}}</p>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
        <div class="form-group">
            <label for="serie_comprobante">Serie Comoprobante</label>
            <p>{{$ingresos->serie_comprobante}}</p>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
        <div class="form-group">
            <label for="num_comprobante">Nº Comoprobante</label>
            <p>{{$ingresos->num_comprobante}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-body">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color:#A9D0F5">
                        <th>Artículos</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Subtotal</th>
                    </thead>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <h4 id="total">{{$ingresos->Total}}</h4>
                        </th>
                    </tfoot>
                    <tbody>
                        @foreach ($detalles as $det)
                            <tr>
                                <td>{{$det->articulo}}</td>
                                <td>{{$det->cantidad}}</td>
                                <td>{{$det->precio_compra}}</td>
                                <td>{{$det->precio_venta}}</td>
                                <td>{{ $det->cantidad*$det->precio_compra}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
