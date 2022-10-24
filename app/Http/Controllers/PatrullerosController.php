<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patrulleros;

class PatrullerosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrulleros = Patrulleros::all();
        
        return view('index',compact('patrulleros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
            'descripcion' => 'required|max:255',
            'estado' => 'required',
        ]);
        $show = patrulleros::create($validatedData);
   
        return redirect('/patrulleros')->with('success', 'Patrullero is successfully saved');
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
        $patrulleros = Patrulleros::findOrFail($id);

        return view('edit', compact('patrulleros'));
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
            'placa' => 'required|max:20',
            'descripcion' => 'required|max:255',
            'estado' => 'required',
        ]);
        Patrulleros::whereId($id)->update($validatedData);

        return redirect('/patrulleros')->with('success', 'Patrullero Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patrulleros = Patrulleros::findOrFail($id);
        $patrulleros->delete();

        return redirect('/patrulleros')->with('success', 'Patrullero Data is successfully deleted');
    }
}
