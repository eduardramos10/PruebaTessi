<?php

use Illuminate\Support\Facades\Route;
use App\Exports\ArticulosExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


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
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categoriaver', 'App\Http\Controllers\CategoriaController@index');
Route::post('/categoriacrear', 'App\Http\Controllers\CategoriaController@store');
Route::put('/categoriamodificar/{id}', 'App\Http\Controllers\CategoriaController@update');
Route::delete('/categoriaeliminar/{id}', 'App\Http\Controllers\CategoriaController@destroy');

Route::get('/articulover', 'App\Http\Controllers\ArticuloController@index');
Route::post('/articulocrear', 'App\Http\Controllers\ArticuloController@store');
Route::put('/articulomodificar/{id}', 'App\Http\Controllers\ArticuloController@update');
Route::delete('/articuloeliminar/{id}', 'App\Http\Controllers\ArticuloController@destroy');

Route::get('/registroempty', 'App\Http\Controllers\ArticuloController@numeroRegistros');

Route::get('/excel', function () {
    return Excel::download(new ArticulosExport, 'articulos.xlsx');
});

