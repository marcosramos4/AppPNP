@extends('panel')
@section('contenido')

    <x-maps-leaflet :centerPoint="['lat' => -16.4009255, 'long' => -71.5388356]" :zoomLevel="80" :markers="[['lat' => -16.4009255, 'long' => -71.5388356]]"></x-maps-leaflet>
@stop
