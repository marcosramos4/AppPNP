<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use App\Models\Patrullero;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class IncidenteController extends Controller
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
        $incidentes = Incidente::all();
        return view('incidente', compact( 'incidentes'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){

        $locations = [];

        foreach (incidente::All() as $incidentes) {

            $locations[] = [
                     //'location' => view('map-tool-tip')->with(['address' => $address])->render(),
                     'latitude' => $incidentes->lat,
                     'longitude' => $incidentes->lng
            ];
        }

        return view('home')->with('locations', $locations);
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
            'lat' => 'required',
            'lng' => 'required',
            'detalle' => '',
            'foto' => '',
            'sector_id' => 'required'
        ]);
        try {
            Incidente::create($validatedData);
            return back()->with(['mensaje' => 'Incidente fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Incidente no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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
        $incidentes = Incidente::all();
        $incidente_show = Patrullero::findOrFail($id);
        return view('incidente', compact( 'incidentes','incidente_show'));
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
        //
    }
}
