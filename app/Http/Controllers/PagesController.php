<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    public function home(){

        $locations = [];     

        foreach (incidentes::All() as $incidentes) {

            $locations[] = [
                     //'location' => view('map-tool-tip')->with(['address' => $address])->render(), 
                     'latitude' => $address->lat, 
                     'longitude' => $address->lng
            ];
        }

        return view('home')->with([
                    'locations' => json_encode($locations)
        ]);
        //return view('home');
    }
    public function dashboard(){
        return view('dashboard');
    }

}
