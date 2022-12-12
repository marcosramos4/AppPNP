<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personales = Personal::orderBy("id", "desc")->get();
        $roles = Rol::all();
        return view('personal', compact('personales', 'roles'));
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
            'DNI' => 'required|min:6',
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'rol_id' => 'required',
        ]);
        $validauser=$request->validate([
            'email' => 'required|email',
        ]);
        $usuario = substr($request->input('nombres'),0, 3) . substr($request->input('apellidos'),0,3).substr($request->input('DNI'),3,3);
        try {
            DB::beginTransaction();
            $personal=Personal::create($validatedData);
            $nuevo=array_merge($validauser, ['name' => $usuario, 'password' => $request->input('DNI'),'personal_id'=>$personal->id]);
            User::create($nuevo);
            DB::commit();
            return back()->with(['mensaje' => 'Personal fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with(['mensaje' => 'Personal no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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
        $personales = Personal::orderBy("id", "desc")->get();
        $roles = Rol::all();
        $personal_show = Personal::findOrFail($id);
        return view('personal', compact('personales', 'personal_show', 'roles'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personales = Personal::orderBy("id", "desc")->get();
        $roles = Rol::all();
        $personal_edit = Personal::findOrFail($id);
        return view('personal', compact('personales', 'personal_edit', 'roles'));

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
            'DNI' => 'required|min:6',
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'correo' => 'required|email',
            'rol_id' => 'required',
        ]);
        $usuario = substr($request->input('nombres'),0, 3) . substr($request->input('apellidos'),0,3).substr($request->input('DNI'),3,3);
        $updatepero=array_merge($validatedData, ['usuario' => $usuario, 'password' => $request->input('DNI')]);
        try {
            if($id>1) {
                Personal::whereId($id)->update($updatepero);
            }
            return redirect('personal')->with(['mensaje' => 'Personal fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('personal')->with(['mensaje' => 'Personal no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
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
           if($id>1){
               Personal::destroy($id);
           }
            return redirect('/personal')->with(['mensaje' => 'Personal fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/personal')->with(['mensaje' => 'Personal no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }

    public function buscar(Request $request)
    {
        $datos = $request->input('datos');
        $filterData = Personal::where('DNI', 'LIKE', '%' . $datos . '%')->orWhere('nombres', 'LIKE', '%'.$datos.'%')->orWhere('apellidos', 'LIKE', '%'.$datos.'%')->get();
        return $filterData;
    }
}
