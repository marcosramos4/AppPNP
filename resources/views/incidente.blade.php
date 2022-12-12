@extends('panel')
@section('contenido')


    <div class="box-typical box-typical-padding">
        <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

            <thead>
            <tr class="text-secondary">
                <th style="width: 5%;">N°</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">ID</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Latitud</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Longitud</th>
                <th class="d-none d-sm-table-cell" style="width: 20%;">detalle</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Foto</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Sector</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>

            </tr>
            </thead>
            <tbody>
            @if($incidentes)
            @foreach($incidentes as $incidente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{route('personal.show',$incidente->id)}}">{{$incidente->id}}</a></td>
                    <td>{{$incidente->latitud}}</td>
                    <td>{{$incidente->longitud}}</td>
                    <td>{{$incidente->detalle}}</td>
                    <td>{{$incidente->foto}}</td>
                    <td>{{$incidente->Sector->nombre}}</td>
                    <td>{{$incidente->estado}}</td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop
