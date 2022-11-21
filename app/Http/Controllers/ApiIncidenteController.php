<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
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
            $validator =Validator::make($request->all(), [
                'latitud' => 'required|numeric',
                'longitud' => 'required|numeric',
                'detalle' => '',
                'fotos' => '',
                'tipo_id' => 'required|integer']);
            if ($validator->fails()) {
                return $this->responseError(null, 'erros in data');
            }
            $filename=null;
            if($request->file('fotos')){
                $file= $request->file('fotos');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/incidentes/fotos'), $filename);
            }

            $incidentenuevo=$validator->validated();
            $incidentenuevo['fotos']=$filename;
            $incidentenuevo['sector_id']=1;

           $incidente= Incidente::create($incidentenuevo);
            return $this->responseSuccess($incidente, 'suces');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $incidente = Incidente::with('Sector', 'Tipo')->get()->where('id',$id);
        return $this->responseSuccess($incidente, 'incidente !');
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
