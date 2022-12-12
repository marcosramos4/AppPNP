<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <script async src="//jsfiddle.net/0dzhs5Lg/3/embed/"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
          integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
            integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="
            crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.freedraw/2.0.1/leaflet-freedraw.web.js" integrity="sha512-Jf2UYAJWPxFD1oZ2P8yytQqnyjGuenrMBYy97V6+tea9Mqj1putwS4G79fi3IiPqJql4s1k9KP7OHQHSPwdTCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .map {
            width: 100vw;
            height: 100vh;
        }

        .map.mode-create {
            cursor: crosshair;
        }

        .leaflet-edge {
            background-color: #95bc59;
            box-shadow: 0 0 0 2px white, 0 0 10px rgba(0, 0, 0, .35);
            border-radius: 50%;
            cursor: move;
            outline: none;
            transition: background-color .25s;
        }

        .leaflet-polygon {
            fill: #b4cd8a;
            stroke: #50622b;
            stroke-width: 2;
            fill-opacity: .75;
        }
    </style>
</head>
<body>
<main>
    <h1>Welcome to My Website</h1>
</main>
<section class="map"></section>

<script>

    const LAT_LNG = [51.505, -0.09];
    const TILE_URL = 'https://cartodb-basemaps-a.global.ssl.fastly.net/light_all/{z}/{x}/{y}@2x.png';

    const map = new L.Map(document.querySelector('section.map'), { doubleClickZoom: false }).setView(LAT_LNG, 14);
    L.tileLayer(TILE_URL).addTo(map);
    const freeDraw = new FreeDraw({ mode: FreeDraw.ALL });
    map.addLayer(freeDraw);
</script>
</body>
</html>
