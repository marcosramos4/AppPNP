<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;


class ApiRegistroController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $registros = Registro::with('Personal','Sector')->get();
            return $this->responseSuccess($registros, 'suces');
        } catch (Exception $e) {
            return $this->responseError(null, 'error');
        }
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
                'personal_id' => 'required|integer',
                'sector_id' => '']);
            if ($validator->fails()) {
                return $this->responseError(null, 'falla');
            }
            $registrocreate=$validator->validated();
            $registrocreate['sector_id']=1;
            $registro = Registro::create($registrocreate);
            return $this->responseSuccess($registro, 'suces');
        } catch (Exception $e) {
            return $this->responseError(null, 'error');
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
        try {
            $registro = Registro::with('Personal','Sector')->get()->where('sector_id', $id);
            return $this->responseSuccess($registro, 'suces');
        } catch (Exception $e) {
            return $this->responseError(null, 'error');
        }
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
