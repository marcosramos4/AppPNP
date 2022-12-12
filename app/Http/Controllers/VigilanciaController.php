<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class VigilanciaController extends Controller
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
        $sectores=Sector::all();
        $sector_show=null;
        $ubicaciion='[-16.398882, -71.536961]';
        return view('vigilancia',compact('sectores','sector_show','ubicaciion'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sectores=Sector::all();
        $sector_show=Sector::findOrFail($id);
        $ubicaciion=$this->Ubicacion($sector_show->cordenadas);
        return view('vigilancia',compact('sectores','sector_show','ubicaciion'));
    }
    private function Ubicacion($cordenadas){
        $cordenadas=json_decode('{"cordenadas":['.$cordenadas.']}');
        $latitud=0;
        $longitud=0;

        foreach ($cordenadas->cordenadas as $cordenada){
            $latitud+=$cordenada[0];
            $longitud+=$cordenada[1];
        }
        $latitud=$latitud/count($cordenadas->cordenadas);
        $longitud=$longitud/count($cordenadas->cordenadas);
        return '['.$latitud.','.$longitud.']';
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
