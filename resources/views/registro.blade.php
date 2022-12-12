@extends('panel')
@section('contenido')


    <div class="box-typical box-typical-padding">
        <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

            <thead>
            <tr class="text-secondary">
                <th style="width: 5%;">N°</th>
                <th class="d-none d-sm-table-cell" style="width: 5%;">ID</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Latitud</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Langitud</th>
                <th class="d-none d-sm-table-cell" style="width: 20%;">detalle</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Nombres</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Apellidos</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Fecha Registro</th>
                <th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>

            </tr>
            </thead>
            <tbody>
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{route('personal.show',$registro->id)}}">{{$registro->id}}</a></td>
                    <td>{{$registro->latitud}}</td>
                    <td>{{$registro->longitud}}</td>
                    <td>{{$registro->detalle}}</td>
                    <td>{{$registro->Personal->nombres}}</td>
                    <td>{{$registro->Personal->apellidos}}</td>
                    <td>{{$registro->created_at}}</td>
                    <td>{{$registro->estado}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


@stop
