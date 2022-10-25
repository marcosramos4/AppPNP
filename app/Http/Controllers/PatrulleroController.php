<?php

namespace App\Http\Controllers;

use App\Models\Patrullero;
use App\Models\PatrulleroCategoria;
use App\Models\PatrulleroEstado;
use App\Models\Patrulleros;
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
        $patrulleros=Patrullero::all();
        $categorias=PatrulleroCategoria::all();
        $estados=PatrulleroEstado::all();
        return view('patrullero',compact('patrulleros','categorias','estados'));
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
            'placa' => 'required|max:20',
            'descripcion' => 'optional',
            'patrullero_estado_id' => 'required',
            'patrullero_categoria_id' => 'required',
        ]);
        patrulleros::create($validatedData);

        //return redirect('/patrullero')->with('success', 'Patrullero is successfully saved');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
