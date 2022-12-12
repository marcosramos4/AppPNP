
@extends('panel')
@section('contenido')
<!--img src="./img/KM2RV7LYF5G6LAHTSDLIAJPTVI.jpg" width="100%">-->
<div id="map" style="height: 700px"></div>
<script>
    var map = L.map('map').setView([-16.39953, -71.535823], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    @foreach($sectores as $sector)
    var polygon = L.polygon([{{$sector->cordenadas}}],{color:'{{$sector->color}}'}).addTo(map);
    polygon.bindPopup("<b>{{$sector->nombre}}</b><br>{{$sector->descripcion}}")
    @endforeach


</script>

    <?php
    /*    $array=[
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
        echo $objeto;*/
        ?>


@stop
