<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
          integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
            integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="
            crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.freedraw/2.0.1/leaflet-freedraw.web.js"
            integrity="sha512-Jf2UYAJWPxFD1oZ2P8yytQqnyjGuenrMBYy97V6+tea9Mqj1putwS4G79fi3IiPqJql4s1k9KP7OHQHSPwdTCQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>
<main>
    <h1>Welcome to My Website</h1>
</main>
<div id="map"></div>
<button onclick="dibujar()">crear</button>
<button onclick="quitar()">quitar</button>
<textarea id="cordenadas"></textarea>

<script>
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
       maxZoom: 19,
       attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    const freeDraw = new FreeDraw({mode: FreeDraw.ALL});
    //map.addLayer(freeDraw);
    freeDraw.on('markers', event => {
        console.log(event.latLngs);
    });
    function dibujar(){
        map.addLayer(freeDraw);
        freeDraw.on('markers', event => {
            document.getElementById('cordenadas').value =event.latLngs[0];
            console.log(event.latLngs);
        });
    }
    function quitar(){
       map.remove(freeDraw);
    }

</script>

</body>
</html>
