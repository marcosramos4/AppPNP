<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Patrullero;
use App\Models\Personal;
use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores=Sector::all();
        $patrulleros=Patrullero::all();
        $asignaciones=Asignacion::all();
        return view('asignacion',compact('sectores','patrulleros','asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patrullero_id' => 'required',
            'sector_id' => 'required',
            'personal' => 'required',
            'descripcion' => '',
        ]);
        $validatedData['personal']=json_encode($validatedData['personal']);
        try {
            Asignacion::create($validatedData);
            return back()->with(['mensaje' => 'Asignación fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Asignación no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sectores=Sector::all();
        $patrulleros=Patrullero::all();
        $asignaciones=Asignacion::all();
        $asignacion_show=Asignacion::findOrFail($id);
        $listaperso=json_decode($asignacion_show->personal);
        $personalAsignado=Personal::WhereIn('id', $listaperso)->get();
        return view('asignacion',compact('sectores','patrulleros','asignaciones','asignacion_show','personalAsignado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Asignacion::destroy($id);
            return redirect('/asignacion')->with(['mensaje' => 'Asignación fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/asignacion')->with(['mensaje' => 'Asignación no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }
}
