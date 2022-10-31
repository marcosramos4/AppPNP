<?php

namespace App\Http\Controllers;

use App\Models\Patrullero;
use App\Models\Sector;
use App\Models\Vehiculo;
use App\Models\Estado;
use App\Models\Patrulleros;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sector');
    }}
