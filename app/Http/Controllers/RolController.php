<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return view('rol', compact( 'roles' ));
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
            'nombre' => 'required|min:3',
            'descripcion' => '',
            'permisos' => ''
        ]);
        try {
            Rol::create($validatedData);
            return back()->with(['mensaje' => 'Rol fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Rol no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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
        $roles = Rol::all();
        $rol_edit = Rol::findOrFail($id);
        return view('rol', compact( 'roles','rol_edit' ));
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
            'nombre' => 'required|min:3',
            'descripcion' => '',
            'permisos' => '',
        ]);
        try {
            Rol::whereId($id)->update($validatedData);
            return redirect('/personal/rol')->with(['mensaje' => 'Rol fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/personal/rol')->with(['mensaje' => 'Rol no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
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
            Rol::destroy($id);
            return redirect('/personal/rol')->with(['mensaje' => 'Rol fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/personal/rol')->with(['mensaje' => 'Rol no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }
}
