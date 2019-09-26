<?php

namespace sisventas\Http\Controllers;

use Illuminate\Http\Request;
use sisventas\Ingreso;
use sisventas\DetalleIngreso;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisventas\Http\Requests\IngresoFormRequest;
use DB;

//espacio de nombre para la fecha y hora
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\TryCatch;

class IngresoController extends Controller
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
            $ingresos = DB::table('ingreso as i')
                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                ->select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto' , 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
                ->where('i.num_comprobante', 'LIKE', '%' . $query . '%')
                ->orderBy('i.idingreso', 'DESC')
                ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto' , 'i.estado')
                ->paginate(7);

            return view('compras.ingreso.index', ["ingresos" => $ingresos, "searchText" => $query]);
        }
    }

    public function create()
    {
        $personas = DB::table('persona')->where('tipo_persona', '=', 'Proveedor')->get();
        $articulos = DB::table('articulo as art')
            ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'), 'art.idarticulo')
            ->where('art.estado', '=', 'Activo')
            ->get();

        return view('compras.ingreso.create', ["personas" => $personas, "articulos" => $articulos]);
    }

    public function store(IngresoFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->idproveedor = $request->get('idproveedor');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');

            $mytime = Carbon::now('America/El_Salvador');
            $ingreso->fecha_hora = $mytime->toDateString();
            $ingreso->impuesto = '13';
            $ingreso->estado = 'Activo';
            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while ($cont < count($idarticulo)) {
                $detalle = new DetalleIngreso();
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();
                $cont = $cont + 1;
            }

            DB::commit();
        } catch (\Exeption $e) {
            DB::rollback();
        }

        return redirect()->route('ingreso.index');
    }

    public function show($id)
    {
        $ingreso = DB::table('ingreso as i')
        ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
        ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
        ->select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto' , 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
        ->where('i.idingreso', '=', $id)
        ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto' , 'i.estado');

        $detalles = DB::table('detalle_ingreso as di')
        ->join('articulo as a','di.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','di.cantidad','di.precio_compra','di.precio_venta')
        ->where('di.idingreso','=',$id)
        ->get();

        return redirect()->route("ingreso.show", ["ingreso" => $ingreso, "detalles" => $detalles]);
    }

    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='Anulado';
        $ingreso->update();
        return redirect()->route('ingreso.index');
    }
}
