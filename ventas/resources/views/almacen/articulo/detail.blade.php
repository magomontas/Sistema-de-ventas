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
        width: 480px;
        text-align: left;
        border-collapse: collapse;
    }

    th {
        font-size: 13px;
        font-weight: normal;
        padding: 8px;
        background: #b9c9fe;
        border-top: 4px solid #aabcfe;
        border-bottom: 1px solid #fff;
        color: #039;
    }

    td {
        padding: 8px;
        background: #e8edff;
        border-bottom: 1px solid #fff;
        color: #669;
        border-top: 1px solid transparent;
    }

    tr:hover td {
        background: #d0dafd;
        color: #339;
    }
</style>
<body>

<div>
        <table>
            <thead>
            <tr>
                <th>N°</th>
                <th>Articulo</th>
                <th>Fecha de emisión:</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ str_pad($articulo->idarticulo,3,'0',STR_PAD_LEFT) }}</td>
                <td>{{ $articulo->nombre }}</td>
                <td>{{ $articulo->created_at }}</td>
            </tr>
            </tbody>
        </table>
    <table>
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
            <td class="">{{ $articulo->codigo  }}</td>
            <td class="">{{ $articulo->stock  }}</td>
            <td class="">{{ $articulo->descripcion  }}</td>
            <td class="">{{ $articulo->imagen  }}</td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>

