<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EstadoController extends Controller
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
        $estados = Estado::all();
        return view('estado', compact( 'estados' ));
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
            'estado' => 'required|max:50',
            'descripcion' => ''
        ]);
        try {
            Estado::create($validatedData);
            return back()->with(['mensaje' => 'Estado fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Estado no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estado::all();
        $estado_edit = Estado::findOrFail($id);
        return view('estado', compact( 'estados','estado_edit' ));
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
        $validatedData = $request->validate([
            'estado' => 'required|max:20',
            'descripcion' => '',
        ]);
        try {
            Estado::whereId($id)->update($validatedData);
            return redirect('/patrullero/estado')->with(['mensaje' => 'Estado fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero/estado')->with(['mensaje' => 'Estado no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
        }
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
            Estado::destroy($id);
            return redirect('/patrullero/estado')->with(['mensaje' => 'Estado fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero/estado')->with(['mensaje' => 'Estado no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }
}
