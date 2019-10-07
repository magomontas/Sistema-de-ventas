<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 12px;
        margin: 45px;
        width: 700px;
        border-collapse: collapse;
    }

    th {
        font-size: 13px;
        font-weight: normal;
        padding: 8px;
        background: #0fccff;
        border-bottom: 1px solid white;
        color: white;
    }

    td {
        padding: 8px;
        background: #e8edff;
        border-bottom: 1px solid #fff;
        color: black;
        border-top: 1px solid transparent;
    }
    h5{
        background-color: #0fccff;
        width: 200px;
        margin: 0px;
    }
    .info{
        text-align: center;
    }

</style>
<body>
<div class="info">
    <h3>Factura de <spam>TechZone</spam></h3>
    Cliente: <br>
    ---------------<br>
    {{$venta->nombre}}<br><br>
    N° de comprobante: <br>
    ---------------<br>
    {{$venta->num_comprobante}}
</div>


<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
    <thead style="background-color:#A9D0F5">
    <tr>
        <th>Artículos</th>
        <th>Cantidad</th>
    </tr>

    </thead>
    <tbody>
    @foreach ($detalles as $det)
        <tr>
            <td>{{$det->articulo}}</td>
            <td>{{$det->cantidad}}</td>
        </tr>
    @endforeach
    <tr>
            <td><h3>Gracias por su Compra!</h3></td>
            <td><h4 id="total">TOTAL: ${{$venta->total_venta}}</h4></td>
        </tr>
    </tbody>
</table>

</body>
</html>

