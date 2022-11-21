<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class Permisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        permiso($request);


        switch ($request->method()){
            case 'GET':
                echo 'get'; break;
            case 'POST':

                echo 'post'; break;
            case 'PUT': echo 'put'; break;
            case 'DELETE': echo 'delete'; break;
        }
        if(true){
            return $next($request);
        }
        return back()->with(['mensaje' => 'Tu usuario no tiene permisos para esta acción', 'tipo' => ' alert-danger', 'titulo' => 'Sin Permisos']);
    }
    private function AutorizadoGet($auto){
        $path=explode('/',request()->getPathInfo());
        if(end($path)){

        }

    }
}
