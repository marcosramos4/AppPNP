<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
Route::resource('login', 'SesionController');
function active($url)
{
    return request()->is($url) ? 'active' : '';
}

Route::get('/mapa', function () {
    return view('mapa');
});
Route::get('/dimapa', function () {
    return view('dimapa');
});

Route::get('/dibujamapa', function () {
    return view('dibujamapa');
});
Route::resource('/', 'homeController');
//pagina

Route::resource('dashboard', 'PaginaController');
Route::resource('alertas', 'AlertaController');
Route::resource('vigilancia', 'VigilanciaController');

//gestion patrullero
Route::resource('patrullero/estado', 'EstadoController');
Route::resource('patrullero/vehiculo', 'VehiculoController');
Route::POST('patrullero/buscar', 'PatrulleroController@buscar');
Route::resource('patrullero', 'PatrulleroController');

//gestion peronal

Route::resource('personal/rol', 'RolController');
Route::POST('personal/buscar', 'PersonalController@buscar');
Route::resource('personal', 'PersonalController');

//gestion sector

Route::resource('subsector/sector', 'SectorController');
Route::POST('subsector/buscar', 'SubSectorController@buscar');
Route::resource('subsector', 'SubSectorController');

//gestion incidente

Route::resource('incidente', 'IncidenteController');

//gestion registro
Route::resource('registro', 'RegistroController');

//gestion asignacion
Route::resource('asignacion', 'AsignacionController');


function permiso(Request $request){
  //  dd($request);
    $persmisos='{"estado":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"vehiculo":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"patrullero":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"personal":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"asignacion":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"sector":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"subsector":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"incidente":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true},"registro":{"visualizar":true,"registrar":true,"editar":true,"eliminar":true}}';
    $persmiso=json_decode($persmisos);

}
