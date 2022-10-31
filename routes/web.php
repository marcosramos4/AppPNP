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
function active($url){
    return request()->is($url) ? 'active' : '';
}

Route::get('/',['as'=>'home','uses'=>'PagesController@home']);
Route::get('/dashboard/{datos?}',['as'=>'dashboard','uses'=>'PagesController@dashboard'])->where('datos',"[A-Za-z]+");
//gestion patrullero
Route::resource('patrullero/estado','EstadoController');
Route::resource('patrullero/vehiculo','VehiculoController');
Route::POST('patrullero/buscar','PatrulleroController@buscar');
Route::resource('patrullero','PatrulleroController');

//gestion peronal

Route::resource('personal/rol','RolController');
Route::POST('personal/buscar','PersonalController@buscar');
Route::resource('personal','PersonalController');


Route::resource('sector','SectorController');

