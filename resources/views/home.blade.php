
@extends('panel')
@section('contenido')

    <x-maps-leaflet :centerPoint="['lat' => -16.50000000, 'long' => -68.15000000]" :zoomLevel="80" :markers="[['lat' => -16.4009255, 'long' => -71.5388356]]"></x-maps-leaflet>
    <?php
        $array=[
            "estado"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "vehiculo"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "patrullero"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "subsector"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "sector"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "personal"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "asignacion"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "incidente"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "registro"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            "reporte"=>["visualizar"=>false,"registrar"=>true,"editar"=>false,"Eliminar"=>true],
            ];
        $objeto=json_encode($array);
        echo $objeto;
        ?>


@stop
