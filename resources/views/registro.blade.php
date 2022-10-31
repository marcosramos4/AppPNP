@extends('panel')
@section('contenido')
    <form class="col-md-4 p-2" method="POST" id="personalBuscar" action="personal/buscar">
        @csrf
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Buscar"
                   name="placa" onkeypress="personalbuscar(this)"/>
        </div>
        <div class="list-group position-absolute " id="listadni">
        </div>
    </form>
    <script>
        function personalbuscar(e) {
            console.log(e.value);
            const xmr = new XMLHttpRequest();
            const formData = new FormData(document.getElementById('personalBuscar'));
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
                <th class="d-none d-sm-table-cell" style="width: 5%;">ID</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Cordenadas</th>
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
                    <td>{{$registro->cordenadas}}</td>
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
