@extends('panel')
@section('contenido')
    http://localhost:8000/api/incidente
    <div class="position-relative">
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
        var map = L.map('map').setView([-16.4009255, -71.5388356], 15);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        // var marker = L.marker([-16.40090, -71.53885]).addTo(map);
        // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        // marker._icon.classList.add("huechange");
        var circle = L.circle([-16.4009100, -71.53881000], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 10
        }).addTo(map);


        function optenerAlertas() {
            let xmr = new XMLHttpRequest();
            xmr.open("GET",'api/incidente', true);
            xmr.send();
            xmr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    //console.log(this.responseText);
                    const alertas = JSON.parse(this.responseText);
                    //console.log(alertas.data);
                    alertas.data.forEach(function (e){
                        console.log(e.tipo.color)
                        L.circle([e.latitud, e.longitud], {
                            color: e.tipo.color,
                            fillColor: e.tipo.color,
                            fillOpacity: 0.5,
                            radius: 10
                        }).addTo(map);
                    });
                    }
            };
        }
        setInterval(optenerAlertas, 5000);

    </script>




@stop
