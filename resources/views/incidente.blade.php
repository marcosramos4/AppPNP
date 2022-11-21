@extends('panel')
@section('contenido')
    <form class="col-md-4 p-2" method="POST" id="incidenteBuscar" action="personal/buscar">
        @csrf
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Buscar"
                   name="placa" onkeypress="incidentelbuscar(this)"/>
        </div>
        <div class="list-group position-absolute " id="listadni">
        </div>
    </form>
    <script>
        function incidentelbuscar(e) {
            console.log(e.value);
            const xmr = new XMLHttpRequest();
            const formData = new FormData(document.getElementById('incidenteBuscar'));
            const listadni = document.getElementById('listadni')
            xmr.open("POST", 'personal/buscar', true);
            xmr.send(formData);
            xmr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const personal = JSON.parse(this.responseText);
                    let alist = '';
                    personal.forEach(perso => alist +=
                        '<a href="/personal/' + perso.id + '" class="list-group-item list-group-item-action">' + perso.DNI + ' ' + perso.nombres + ' ' + perso.apellidos + '</a>');
                    listadni.innerHTML = alist;
                }
            };
        }
    </script>

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
                    <td>{{$incidente->lat}}</td>
                    <td>{{$incidente->lng}}</td>
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
