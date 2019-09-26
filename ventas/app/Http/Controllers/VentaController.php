<?php

namespace sisventas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisventas\Http\Requests\VentaFormRrequest;

use sisventas\Venta;
use sisventas\DetalleVenta;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    //Agregar espacios de nombre arriba
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $ventas = DB::table('venta as v')
                ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
                ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
                ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto' , 'v.estado', 'v.total_venta')
                ->where('v.num_comprobante', 'LIKE', '%' . $query . '%')
                ->orderBy('v.idventa', 'DESC')
                ->groupBy('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto' , 'v.estado','v.total_venta')
                ->paginate(7);

            return view('ventas.venta.index', ["ventas" => $ventas, "searchText" => $query]);
        }
    }

    public function create()
    {
        $personas = DB::table('persona')->where('tipo_persona', '=', 'Cliente')->get();
        $articulos = DB::table('articulo as art')
            ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'), 'art.idarticulo','art.stock', DB::raw('avg(di.precio_venta) as precio_promedio'))
            ->where('art.estado', '=', 'Activo')
            ->where('art.stock','>','0')
            ->groupBy('articulo','art.idarticulo','art.stock')
            ->get();

        return view('ventas.venta.create', ["personas" => $personas, "articulos" => $articulos]);
    }

    public function store(VentaFormRrequest $request)
    {
        try {
            DB::beginTransaction();
            $venta = new Venta;
            $venta->idcliente = $request->get('idcliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->serie_comprobante = $request->get('serie_comprobante');
            $venta->num_comprobante = $request->get('num_comprobante');
            $venta->total_venta = $request->get('total_venta');

            $mytime = Carbon::now('America/El_Salvador');
            $venta->fecha_hora = $mytime->toDateString();
            $venta->impuesto = '13';
            $venta->estado = 'A';
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while ($cont < count($idarticulo)) {
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->idventa;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();
                $cont = $cont + 1;
            }

            DB::commit();
        } catch (\Exeption $e) {
            DB::rollback();
        }

        return redirect()->route('venta.index');
    }

//    public function show($id)
//    {
//        $venta = DB::table('venta as v')
//            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
//            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
//            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto' , 'v.estado', 'v.total_venta')
//            ->where('v.idventa', '=', $id)
//            ->first();
//
//        $detalles = DB::table('detalle_venta as dv')
//            ->join('articulo as a','dv.idarticulo','=','a.idarticulo')
//            ->select('a.nombre as articulo','dv.cantidad','dv.descuento','dv.precio_venta')
//            ->where('dv.idventa','=',$id)
//            ->get();
//
//        return redirect()->route("venta.show", ["venta" => $venta, "detalles" => $detalles]);
//    }
    public function show($id)
    {
        $venta = Venta::where('idventa', $id)->first();
        $venta = DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
            ->where('v.idventa', '=', $id)
            ->first();
        $detalles = DB::table('detalle_venta as dv')
            ->join('articulo as a', 'dv.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'dv.cantidad', 'dv.descuento', 'dv.precio_venta')
            ->where('dv.idventa', '=', $id)
            ->get();

        return view('ventas.venta.show', ["venta" => $venta, "detalles"=>$detalles]);
    }


    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado='C';
        $venta->update();
        return redirect()->route('venta.index');
    }
}
