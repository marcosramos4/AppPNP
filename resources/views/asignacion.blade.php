@extends('panel')
@section('contenido')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion Asignación</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <div class="tab-content" >
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
             tabindex="0">
            <div class="text-end p-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                    &#43; Nueva Asignación
                </button>
            </div>
            <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Asignación de Personal</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-4" method="POST" action="{{route('asignacion.store')}}">
                                @csrf
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Patrullero</label>
                                            <select class="form-select" name="patrullero_id">
                                                <option value="0">Sin Patrullero</option>
                                                @foreach($patrulleros as $patrullero)
                                                    <option value="{{$patrullero->id}}">{{$patrullero->Placa}}</option>
                                                @endforeach
                                            </select>
                                            {!!$errors->first('patrullero_id','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Sector</label>
                                            <select class="form-select" name="sector_id">
                                                @foreach($sectores as $sector)
                                                    <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                                @endforeach
                                            </select>
                                            {!!$errors->first('rol_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputEmail4" class="form-label ">Personal(*)</label>
                                            <ul class="list-group" id="listapersonal">


                                            </ul>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="inputEmail4" class="form-label ">Detalle(*)</label>
                                            <textarea type="text" class="form-control"
                                                   name="detalle" {{old('detalle')}}></textarea>
                                                {!!$errors->first('detalle','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>

                            <div class="position-relative w-100">
                                <form class=" p-2" method="POST" id="personalBuscar" action="personal/buscar">
                                    @csrf
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded" placeholder="Buscar"
                                               name="placa" onkeypress="personalbuscarasig(this)"/>
                                    </div>
                                    <div class="list-group position-absolute " id="listadni">
                                    </div>
                                </form>

                            </div>

                            <script>
                                function personalbuscarasig(e) {
                                    console.log(e.value);
                                    const xmr = new XMLHttpRequest();
                                    const formData = new FormData(document.getElementById('personalBuscar'));
                                    const listadni = document.getElementById('listadni')
                                    listadni.innerHTML='';
                                    xmr.open("POST", 'personal/buscar', true);
                                    xmr.send(formData);
                                    xmr.onreadystatechange = function () {
                                        if (this.readyState === 4 && this.status === 200) {
                                            const personal = JSON.parse(this.responseText);
                                            let alist = '';
                                            personal.forEach(perso => alist +=
                                                '<label class="list-group-item list-group-item-action" onclick="agregarpersonal(this)" title="'+perso.id+'">' + perso.DNI + ' ' + perso.nombres + ' ' + perso.apellidos + '</label>');
                                            listadni.innerHTML = alist;
                                        }
                                    };
                                }


                                function agregarpersonal(perso){
                                    var item='<li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="personal[]" value="'+perso.title+'">'+perso.innerHTML+' <span class="btn-close btn" onclick="quitar(this)"></span></li>'
                                    var listapersonal=document.getElementById('listapersonal');
                                    listapersonal.innerHTML=listapersonal.innerHTML+item;
                                }
                                function quitar(e){
                                    var ele=e.target;
                                    console.log(ele);

                                }
                            </script>


                        </div>

                    </div>
                </div>
            </div>

            @if($errors->first())
                <script>

                    window.addEventListener('load', function () {

                        const myModal2 = new bootstrap.Modal('#staticBackdrop', {
                            keyboard: true
                        });
                        myModal2.show();
                    });

                </script>
            @endif
            <div class="box-typical box-typical-padding">
                <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

                    <thead>
                    <tr class="text-secondary">
                        <th style="width: 5%;">N°</th>
                        <th style="width: 5%;">Asignación</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Sector</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Patrullero</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Agentes</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Detalle</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Fecha</th>
                        <th class="text-center" style="width: 10%;">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    @isset($asignaciones)
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{route('asignacion.show',$asignacion->id)}}">{{$asignacion->id}}</a></td>
                            <td>{{$asignacion->Sector->nombre}}</td>
                            <td>{{$asignacion->patrullero==null?'sin Patrullero':$asignacion->patrullero->placa}}</td>
                            <td><?php $personal=json_decode($asignacion->personal);
                                echo count($personal);
                                    ?></td>
                            <td>{{$asignacion->detalle}}</td>
                            <td>{{$asignacion->created_at}}</td>
                            <td class="text-center fs-5">
                                <form action="{{route('asignacion.destroy',$asignacion->id)}}" method="POST"
                                      class="d-inline ">
                                    @csrf
                                    {!! method_field('DELETE') !!}
                                    <button class="confirmar text-secondary border-0 bg-transparent p-0"
                                            type="submit">
                                        &#128465
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endisset

                    </tbody>
                </table>
            </div>

        </div>
        @isset($personal_edit)
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true"
                 data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Personal</h1>
                            <a href="/personal" type="button" class="btn-close" aria-label="Close"></a>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('personal.update',$personal_edit->id)}}" method="POST">
                                {!! method_field('PUT') !!}
                                @csrf
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label ">DNI(*)</label>
                                            <input type="text" class="form-control" value="{{$personal_edit->DNI}}"
                                                   name="DNI" {{old('DNI')}}>
                                            {!!$errors->first('DNI','<div class="invalid-feedback d-block">:message</div>')!!}

                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Rol</label>
                                            <select class="form-select" name="rol_id">
                                                @foreach($roles as $rol)
                                                    <option
                                                        value="{{$rol->id}}" {{$personal_edit->rol_id==$rol->id?'selected':''}}>{{$rol->nombre}}</option>
                                                @endforeach
                                            </select>
                                            {!!$errors->first('rol_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputEmail4" class="form-label ">Nombres(*)</label>
                                            <input type="text" class="form-control" value="{{$personal_edit->nombres}}"
                                                   name="nombres" {{old('nombres')}}>
                                            {!!$errors->first('nombres','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputEmail4" class="form-label ">Apéllidos(*)</label>
                                            <input type="text" class="form-control"
                                                   value="{{$personal_edit->apellidos}}"
                                                   name="apellidos" {{old('apellidos')}}>
                                            {!!$errors->first('apellidos','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputEmail4" class="form-label ">Correo(*)</label>
                                            <input type="email" class="form-control" value="{{$personal_edit->correo}}"
                                                   name="correo" {{old('correo')}}>
                                            {!!$errors->first('correo','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{route('personal.index')}}" type="button"
                                       class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @endisset
        @isset($asignacion_show)
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true"
                 data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle Personal</h1>
                            <a href="{{route('asignacion.index')}}" type="button" class="btn-close"
                               aria-label="Close"></a>
                        </div>
                        <div class="modal-body fs-6">
                            <p><b> Sector:</b> {{$asignacion_show->Sector->nombre}} </p>
                            <p><b>Patrullero: </b>{{$asignacion_show->patrullero==null?'sin Patrullero':$asignacion_show->patrullero->placa}}</p>
                            <p><b>Detalle: </b>{{$asignacion_show->detalle}}</p>
                            <h4>Personal</h4>
                            @foreach($personalAsignado as $personal)
                                <p><b>Datos:</b>DNI: {{$personal->DNI}}, Nombres:{{$personal->nombres}} Apellidos:{{$personal->apellidos}} </p>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <p>Creado: {{$asignacion_show->created_at}} /
                                Actualizado: {{$asignacion_show->updated_at}}</p>
                        </div>
                        <div>
                            <div class="modal-footer fs-5 ">
                                <form action="{{route('asignacion.destroy',$asignacion_show->id)}}" method="POST"
                                      class="d-inline ">
                                    @csrf
                                    {!! method_field('DELETE') !!}
                                    <button class="confirmar  link-primary border-0 bg-transparent p-0"
                                            type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        @endisset
        <script>

            window.addEventListener('load', function () {

                const myModal = new bootstrap.Modal('#myModal', {
                    keyboard: true
                });
                myModal.show();
            });

        </script>
    </div>
@stop
