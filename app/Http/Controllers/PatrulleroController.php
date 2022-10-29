<?php

namespace App\Http\Controllers;

use App\Models\Patrullero;
use App\Models\Vehiculo;
use App\Models\Estado;
use App\Models\Patrulleros;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PatrulleroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrulleros = Patrullero::orderBy("id", "desc")->get();
        $vehiculos = Vehiculo::all();
        $estados = Estado::all();
        return view('patrullero', compact('patrulleros', 'vehiculos', 'estados'));
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
            'placa' => 'required|max:20',
            'descripcion' => '',
            'vehiculo_id' => 'required',
            'estado_id' => 'required',
        ]);
        try {
            Patrullero::create($validatedData);
            return back()->with(['mensaje' => 'Patrullero fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Patrullero no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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
        $patrulleros = Patrullero::orderBy("id", "desc")->get();
        $vehiculos = Vehiculo::all();
        $estados = Estado::all();
        $patrullero_show = Patrullero::findOrFail($id);
        return view('patrullero', compact('patrulleros', 'patrullero_show', 'vehiculos', 'estados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patrulleros = Patrullero::orderBy("id", "desc")->get();
        $vehiculos = Vehiculo::all();
        $estados = Estado::all();
        $patrullero_edit = Patrullero::findOrFail($id);
        return view('patrullero', compact('patrulleros', 'patrullero_edit', 'vehiculos', 'estados'));
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
            'placa' => 'required|max:20',
            'descripcion' => '',
            'vehiculo_id' => 'required',
            'estado_id' => 'required',
        ]);
        try {
            Patrullero::whereId($id)->update($validatedData);
            return redirect('patrullero')->with(['mensaje' => 'Patrullero fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('patrullero')->with(['mensaje' => 'Patrullero no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
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
            Patrullero::destroy($id);
            return redirect('/patrullero')->with(['mensaje' => 'Patrullero fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero')->with(['mensaje' => 'Patrullero no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }

    public function buscar(Request $request)
    {
        $placa = $request->input('placa');
        $filterData = Patrullero::where('placa', 'LIKE', '%'.$placa.'%')->get();
        return $filterData;
    }
}
