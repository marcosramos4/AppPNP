<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use App\Models\Sector;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiIncidenteController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $incidentes = Incidente::with('Sector', 'Tipo')->get();
        return $this->responseSuccess($incidentes, 'incidente !');
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
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitud' => 'required|numeric',
                'longitud' => 'required|numeric',
                'detalle' => '',
                'fotos' => '',
                'sector_id' => '',
                'tipo_id' => 'required|integer']);
            if ($validator->fails()) {
                return $this->responseError(null, 'erros in data');
            }
            $filename = null;
            if ($request->file('fotos')) {
                $file = $request->file('fotos');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('incidentes/fotos'), $filename);
            }
            $incidentenuevo = $validator->validated();
            $incidentenuevo['fotos'] = $filename;
            $incidentenuevo['sector_id'] = $this->obtenerSector($incidentenuevo['latitud'],$incidentenuevo['longitud']);
            $incidente = Incidente::create($incidentenuevo);
            return $this->responseSuccess($incidente, 'suces');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage());
        }


    }

    private function obtenerSector($latitud, $longitud)
    {

        $sectorId = 1;
        $sectores = Sector::all();
        foreach ($sectores as $sector) {
            $poligono = json_decode('{"cordenadas":[' . $sector->cordenadas . ']}');
           $si=$this->inArea($latitud,$longitud,$poligono->cordenadas);
           if($si){
               return $sector->id;
           }

        }
        return $sectorId;

    }


    private function inArea($x, $y, $arr)
    {
        // Número de puntos
        $count = count($arr);
        $n = 0; // El número de puntos cruzados por la línea
        $bool = 0; // fuera
        for ($i = 0, $j = $count - 1; $i < $count; $j = $i, $i++) {
            $px1 = $arr[$i][0];
            $py1 = $arr[$i][1];
            $px2 = $arr[$j][0];
            $py2 = $arr[$j][1];

            if ($x >= $px1 || $x >= $px2) {
                if (($y >= $py1 && $y <= $py2) || ($y >= $py2 && $y <= $py1)) {
                    if (($y == $py1 && $x == $px1) || ($y == $py2 && $x == $px2)) {
                        $bool = 2; // En el punto
                        return $bool;
                    } else {
                        $px = $px1 + ($y - $py1) / ($py2 - $py1) * ($px2 - $px1);
                        if ($px == $x) {
                            $bool = 3; // En línea
                        } elseif ($px < $x) {
                            $n++;
                        }

                    }
                }
            }

        }
        if ($n % 2 != 0) {
            $bool = 1;
        }
        return $bool;
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $incidentes = Incidente::with('Sector', 'Tipo')->get()->where('sector_id', $id);
        return $this->responseSuccess($incidentes, 'incidente !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
