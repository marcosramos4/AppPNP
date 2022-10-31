<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{

    public function home(){


        return view('home');
    }
    public function dashboard(){
        return view('dashboard');
    }

}
