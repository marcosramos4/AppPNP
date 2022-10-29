<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',['as'=>'home','uses'=>'PagesController@home']);
Route::get('/dashboard/{datos?}',['as'=>'dashboard','uses'=>'PagesController@dashboard'])->where('datos',"[A-Za-z]+");
Route::resource('patrullero/estado','EstadoController');
Route::resource('patrullero/vehiculo','VehiculoController');
Route::POST('patrullero/buscar','PatrulleroController@buscar');
Route::resource('patrullero','PatrulleroController');




