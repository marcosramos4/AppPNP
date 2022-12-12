<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RolController extends Controller
{
    const MODULOS = [
        'estado' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'vehiculo' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'patrullero' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'personal' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'asignacion' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'sector' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'subsector' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'incidente' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
        'registro' => ['visualizar' => false, 'registrar' => false, 'editar' => false, 'eliminar' => false,],
    ];

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
        $roles = Rol::all();
        $modulos = self::MODULOS;
        return view('rol', compact('roles', 'modulos'));
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
            'nombre' => 'required|min:3',
            'descripcion' => '',
            'permisos' => 'required'
        ]);
        $validatedData['permisos'] = self::permisos($validatedData['permisos']);
        try {
            Rol::create($validatedData);
            return back()->with(['mensaje' => 'Rol fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'Rol no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
        }
    }

    private function permisos($permisosinput)
    {
        $modulos = self::MODULOS;
        foreach ($permisosinput as $key => $value) {
            foreach ($modulos as $per => $es) {
                if ($per == $key) {
                    foreach ($value as $io => $opl) {
                        foreach ($es as $ju => $lki) {
                            if ($io == $ju) {
                                $modulos[$per][$ju] = true;
                            }
                        }
                    }
                }
            }
        }
        return json_encode($modulos);
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
        $roles = Rol::all();
        $modulos = self::MODULOS;
        $rol_edit = Rol::findOrFail($id);
        return view('rol', compact('roles', 'rol_edit','modulos'));
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
            'nombre' => 'required|min:3',
            'descripcion' => '',
            'permisos' => 'required',
        ]);
        $validatedData['permisos'] = self::permisos($validatedData['permisos']);
        try {
            if($id>1) {
                Rol::whereId($id)->update($validatedData);
            }
            return redirect('/personal/rol')->with(['mensaje' => 'Rol fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/personal/rol')->with(['mensaje' => 'Rol no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
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
            if($id>1) {
                Rol::destroy($id);
            }
            return redirect('/personal/rol')->with(['mensaje' => 'Rol fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/personal/rol')->with(['mensaje' => 'Rol no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }
}
