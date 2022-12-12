<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidente;
use App\Models\Registro;
use Carbon\Carbon;
use DB;


class PaginaController extends Controller
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
        $countIncidenteRobo = Incidente::where('tipo_id','=',1)->count();
        $countIncidenteIncendio = Incidente::where('tipo_id','=',2)->count();
        $countIncidenteAlerta = Incidente::where('tipo_id','=',3)->count();
        //$countIncidenteRobo = count($incidenteRobo);

        $countIncidentsMonth = Incidente::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count', 'month_name');

                $labels = $countIncidentsMonth->keys();
                $data = $countIncidentsMonth->values();
        $todayIncidentAmount = Incidente::whereDate('created_at', Carbon::today())->count();
        $incidentAmount = Incidente::count();
        $registroAmount = Registro::count();
        return view('dashboard', compact ('todayIncidentAmount','incidentAmount', 'registroAmount','labels', 'data', 'countIncidenteRobo','countIncidenteIncendio','countIncidenteAlerta'));
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
