<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SubSectorController extends Controller
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
        $subSectores = SubSector::orderBy("id", "desc")->get();
        $sectores = Sector::all();
        return view('subSector', compact('subSectores', 'sectores'));
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
            'lugar' => 'required|min:2',
            'direccion' => 'required',
            'descripcion' => '',
            'sector_id' => 'required'
        ]);
        try {
            SubSector::create($validatedData);
            return back()->with(['mensaje' => 'SubSector fué registrado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return back()->with(['mensaje' => 'SubSector no fué registrado ', 'tipo' => ' alert-danger', 'titulo' => 'Error']);
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
        $subSectores = SubSector::orderBy("id", "desc")->get();
        $sectores = Sector::all();
        $subSector_show = SubSector::findOrFail($id);
        return view('subsector', compact('subSectores', 'sectores', 'subSector_show'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subSectores = SubSector::orderBy("id", "desc")->get();
        $sectores = Sector::all();
        $subSector_edit = SubSector::findOrFail($id);
        return view('subsector', compact('subSectores', 'sectores', 'subSector_edit'));

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
            'lugar' => 'required|min:2',
            'direccion' => 'required',
            'descripcion' => '',
            'sector_id' => 'required'
        ]);
        try {
            SubSector::whereId($id)->update($validatedData);
            return redirect('subsector')->with(['mensaje' => 'SubSector fué Actualizado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('subsector')->with(['mensaje' => 'SubSector no fué Actualizado', 'tipo' => 'alert-danger', 'titulo' => 'Error']);
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
            SubSector::destroy($id);
            return redirect('/subsector')->with(['mensaje' => 'subSector fué Eliminado', 'tipo' => 'alert-success', 'titulo' => 'Realizado']);
        } catch (QueryException $e) {
            return redirect('/subsector')->with(['mensaje' => 'subSector no fué Eliminado', 'tipo' => 'alert-warning', 'titulo' => 'Error']);
        }
    }
    public function buscar(Request $request)
    {
        $datos = $request->input('datos');
        $filterData = SubSector::where('lugar', 'LIKE', '%' . $datos . '%')->get();
        return $filterData;
    }
}
