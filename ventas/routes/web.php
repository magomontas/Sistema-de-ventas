<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth/login');
});

//Route::get('/admin', function () {
//    return view('layouts.home');
//});
Route::get('/admin', 'ArticuloController@masvendido')->name('alta');
Route::get('/cerrar', 'VentaController@totalVentas')->name('cerrar');


Route::resource('almacen/categoria', 'CategoriaController');
//Imprimir una vista
Route::get('/alamacen/imprimir/{id}','ArticuloController@detail');
Route::get('/ventas/imprimir/{id}','VentaController@detail');
Route::resource('almacen/articulo', 'ArticuloController');
Route::resource('ventas/cliente', 'ClienteController');
Route::resource('compras/proveedor', 'ProveedorController');
Route::resource('compras/ingreso', 'IngresoController');
Route::resource('ventas/venta', 'VentaController');
Route::resource('seguridad/usuario', 'UsuarioController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{slug?}', 'HomeController@index')->name('undefined');

