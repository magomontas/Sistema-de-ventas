<?php

namespace sisventas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use sisventas\Http\Requests\ArticuloFormRequest;
use sisventas\Articulo;
use DB;
use sisventas\Categoria;
use Illuminate\Support\Facades\Storage;

class ArticuloController extends Controller
{
     //Agregar espacios de nombre arriba
     public function __construct()
     {
         $this->middleware('auth'); 
     }
     public function index(Request $request)
     {
         if ($request)
         {
             $query=trim($request->get('searchText'));
             $articulos=DB::table('articulo as a')
             ->join('categoria as c', 'a.idcategoria','=','c.idcategoria')
             ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
             ->where('a.nombre','LIKE','%'.$query.'%')
             ->orwhere('a.codigo','LIKE','%'.$query.'%')
             ->orderBy('a.idarticulo','DESC')
             ->paginate(7);
 
             return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
             // return view('almacen.categoria.index', compact('categorias'));
         }
     }
 
     public function create()
     {
         $categorias=DB::table('categoria')->where('condicion','=','1')->get();
         return view("almacen.articulo.create",["categorias"=>$categorias]);
     }
 
     public function store(ArticuloFormRequest $request)
     {
         $articulo = new Articulo();
         $articulo->idcategoria=$request->get('idcategoria');
         $articulo->codigo=$request->get('codigo');
         $articulo->nombre=$request->get('nombre');
         $articulo->stock=$request->get('stock');
         $articulo->descripcion=$request->get('descripcion');
         $articulo->estado='Activo';
         if (Input::hasFile('imagen')){
             $file=Input::file('imagen');
             $file->move(public_path().'/images/articulos',$file->getClientOriginalName());
             $articulo->imagen=$file->getClientOriginalName();
         }

         $articulo->save();
         return redirect()->route('articulo.index');
     }
 
     public function show($id)
     {
         return view("almacen.articulo.show", ["articulo"=>Articulo::findOrFail($id)]);
     }
 
     public function edit($id)
     {
         $articulo=Articulo::findOrFail($id);
         $categorias=DB::table('categoria')->where('condicion','=','1')->get();
         return view("almacen.articulo.edit", ["articulo"=>$articulo,"categorias"=>$categorias]);
     }
 
     public function update(ArticuloFormRequest $request, $id)
     {
         $articulo=Articulo::findOrFail($id);
         $articulo->idcategoria=$request->get('idcategoria');
         $articulo->codigo=$request->get('codigo');
         $articulo->nombre=$request->get('nombre');
         $articulo->stock=$request->get('stock');
         $articulo->descripcion=$request->get('descripcion');
         $articulo->estado='Activo';
         if (Input::hasFile('imagen')){
             $file=Input::file('imagen');
             $file->move(public_path().'/images/articulos',$file->getClientOriginalName());
             $articulo->imagen=$file->getClientOriginalName();
         }
         $articulo->update();
 
         return redirect()->route('articulo.index');
     }
 
     public function destroy($id)
     {
         $articulo=Articulo::findOrFail($id);
         $articulo->estado='Inactivo';
         $articulo->update();
 
         // return Redirect::to("almacen/categoria");
         return redirect()->route('articulo.index');
     }
}
