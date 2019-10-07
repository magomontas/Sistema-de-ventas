@extends('layouts.admin')
{{ Html::style('css/style.css') }}


@section('first')
    <style>
        .tr1 {
            color: red;
        }

        .tr2 {
            color: #ff900d;
        }

        .bx {
            background-color: #9658ff;
            color: #00ff1f;
        }

        .table {
            background-color: #ff4075;
            font-weight: 900;
            font-size: 16px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="title">Listado de Productos mas vendidos</h4>
            <div class="container">
                @foreach($articulos as $art)
                    <div class="card">
                        <img src="{{ asset('images/articulos/'.$art->imagen) }}" alt="">
                        <h4>{{ $art->nombre }}</h4>
                        <p>Total de ventas de este articulo: {{ $art->TotalVentas }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- /.box-header -->

    <div class="row mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="title">Listado de productos con menos stock</h4>
            <div class="containerr1">
                @foreach($detalles as $det)
                    <div class="cardr1">
                        <img class="img-art" src="{{ asset('images/articulos/'.$det->imagen) }}" alt="">
                        <h4>{{ $det->nombre }}</h4>
                        <p>
                            Categoria a la que pertenece: {{ $det->categoria }}
                            Cantidad actual:
                        <li class="fas fa-exclamation-triangle tr2">{{ $det->stock }}</li>
                        </p>
                    </div>
                @endforeach
            </div>
            {{ $detalles->render() }}
        </div>
    </div>

@endsection


