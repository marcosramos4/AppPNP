<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use App\Models\Patrullero;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class IniciosesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('iniciosesion');
    }
}
