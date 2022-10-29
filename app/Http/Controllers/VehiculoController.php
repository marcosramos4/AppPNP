<?php

namespace App\Http\Controllers;


use App\Models\Vehiculo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculo', compact( 'vehiculos', ));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehiculo' => 'required|max:50',
            'descripcion' => ''
        ]);
        try {
            Vehiculo::create($validatedData);
            return back()->with(['mensaje' => 'Vehículo fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Vehículo no fué registrado', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculos = Vehiculo::all();
        $vehiculo_edit = Vehiculo::findOrFail($id);
        return view('vehiculo', compact( 'vehiculos','vehiculo_edit' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vehiculo' => 'required|max:20',
            'descripcion' => '',
        ]);
        try {
            Vehiculo::whereId($id)->update($validatedData);
            return redirect('/patrullero/vehiculo')->with(['mensaje' => 'Vehículo fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero/vehiculo')->with(['mensaje' => 'Vehículo no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Vehiculo::destroy($id);
            return redirect('/patrullero/vehiculo')->with(['mensaje' => 'Vehículo fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero/vehiculo')->with(['mensaje' => 'Vehículo no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }
}
