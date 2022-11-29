@extends('panel')
@section('contenido')
    <div class="position-relative " style="margin-left: -0.8%;margin-right: -0.8%">
        <div id="map" style="height: 700px"></div>
        <div class="position-absolute top-0 end-0 alert bg-dark bg-opacity-50 m-2 text-white" style="z-index: 500">
                <label  class="form-label ">Sector</label>
                <select class="form-select bg-white  bg-opacity-50" name="rol_id" onchange="document.location.href=this.value">
                    <option value="{{route('alertas.index')}}" {{$sector_show==null?'selected':''}}>Todos</option>
                    @foreach($sectores as $sector)
                        <option value="{{route('alertas.show',$sector->id)}}" @if($sector_show) {{$sector_show->id==$sector->id?'selected':''}}@endif >{{$sector->nombre}}</option>
                    @endforeach
                </select>
        </div>
    </div>

    <style>
        img.huechange {
            filter: hue-rotate(146deg);
        }
    </style>

    <script>
        var URL='/api/incidente/@if($sector_show){{$sector_show->id}}@endif';
        var map = L.map('map').setView({{$ubicaciion}},{{$sector_show==null?'15':'18'}});
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        optenerAlertas();
        function optenerAlertas() {

            let xmr = new XMLHttpRequest();
            xmr.open("GET",URL, true);
            xmr.send();
            xmr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    map.eachLayer((layer) => {
                        // console.log(layer._leaflet_id);
                        if(layer._leaflet_id>50){
                            layer.remove();
                        }
                    });
                    //console.log(this.responseText);
                    const alertas = JSON.parse(this.responseText);
                    //console.log(alertas.data);
                    alertas.data.forEach(function (e){
                        console.log(e.tipo.color)
                      L.circle([e.latitud, e.longitud], {
                            color: e.tipo.color,
                            fillColor: e.tipo.color,
                            fillOpacity: 0.5,
                            radius: 30
                        }).addTo(map).bindPopup("<b>Fecha:"+new Date(e.updated_at).toLocaleString()+"<label width='300px'><b>Mensaje:</b>"+e.detalle+"<br><img width='100%' src=incidentes/fotos/"+e.fotos+">");
                    });
                    }
            };
        }
        setInterval(optenerAlertas, 10000);

    </script>




@stop
