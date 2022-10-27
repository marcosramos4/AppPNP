<?php

namespace App\Http\Controllers;

use App\Models\Patrullero;
use App\Models\PatrulleroCategoria;
use App\Models\PatrulleroEstado;
use App\Models\Patrulleros;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;
use mysql_xdevapi\Exception;

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
        $categorias = PatrulleroCategoria::all();
        $estados = PatrulleroEstado::all();
        return view('patrullero', compact('patrulleros', 'categorias', 'estados'));
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
            'patrullero_estado_id' => 'required',
            'patrullero_categoria_id' => 'required',
        ]);
        try {
            Patrullero::create($validatedData);
            return redirect('/patrullero')->with(['mensaje' => 'Patrullero fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero')->with(['mensaje' => 'Patrullero no fué registrado', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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
        $patrulleros = Patrullero::orderBy("id", "desc")->get();
        $categorias = PatrulleroCategoria::all();
        $estados = PatrulleroEstado::all();
        $patrullero_edit = Patrullero::findOrFail($id);
        return view('patrullero', compact('patrulleros', 'categorias', 'estados', 'patrullero_edit'));
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
            'patrullero_estado_id' => 'required',
            'patrullero_categoria_id' => 'required',
        ]);
        try {
            Patrulleros::whereId($id)->update($validatedData);
            return redirect('/patrullero')->with(['mensaje' => 'Patrullero fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/patrullero')->with(['mensaje' => 'Patrullero no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Realizado']);
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
        //
    }
}
