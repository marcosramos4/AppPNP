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
    public function index()
    {
        try {
            $registros = Registro::all();
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
                'personal_id' => 'required|integer']);
            if ($validator->fails()) {
                return $this->responseError(null, 'falla');
            }
            $registro = Registro::create($validator->validated());
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
    public function show($id)
    {
        try {
            $registro = Registro::findOrFail($id);
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
