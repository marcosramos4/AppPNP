
@extends('panel')
@section('contenido')

    <x-maps-leaflet :centerPoint="['lat' => -16.4009255, 'long' => -71.5388356]" :zoomLevel="80"></x-maps-leaflet>


    @foreach($locations as $location)
    <x-maps-leaflet :markers="[['lat' => {{ $location->latitude }}, 'long' => {{ $location->longitude }}]]">
    </x-maps-leaflet>

    @endforeach

@stop
