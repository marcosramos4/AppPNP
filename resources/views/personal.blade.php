@extends('panel')
@section('contenido')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion Personal</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a href="{{route('personal.index')}}" class="nav-link {{active('personal')}}">Personal</a>
            <a href="{{route('rol.index')}}" class="nav-link {{active('personal/rol')}} ">Rol</a>
        </div>
    </nav>


    <div class="tab-content" id="nav-tabContent">
        @yield('personal_contenido')
        @if(isset($personales))
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                 tabindex="0">
                <div class="text-end p-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                        &#43; Nuevo Personal
                    </button>
                </div>
                <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1"
                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Personal</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-4" method="POST" action="{{route('personal.store')}}">
                                    @csrf
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label ">DNI(*)</label>
                                                <input type="text" class="form-control"
                                                       name="DNI" {{old('DNI')}}>
                                                {!!$errors->first('DNI','<div class="invalid-feedback d-block">:message</div>')!!}

                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Rol</label>
                                                <select class="form-select" name="rol_id">
                                                    @foreach($roles as $rol)
                                                        <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                                                    @endforeach
                                                </select>
                                                {!!$errors->first('rol_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label ">Nombres(*)</label>
                                                <input type="text" class="form-control"
                                                       name="nombres" {{old('nombres')}}>
                                                {!!$errors->first('nombres','<div class="invalid-feedback d-block">:message</div>')!!}
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label ">Apéllidos(*)</label>
                                                <input type="text" class="form-control"
                                                       name="apellidos" {{old('apellidos')}}>
                                                {!!$errors->first('apellidos','<div class="invalid-feedback d-block">:message</div>')!!}
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label ">Correo(*)</label>
                                                <input type="email" class="form-control"
                                                       name="correo" {{old('correo')}}>
                                                {!!$errors->first('correo','<div class="invalid-feedback d-block">:message</div>')!!}
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
                            <th class="d-none d-sm-table-cell" style="width: 10%;">DNI</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Nombres</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Apellidos</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Correo</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Rol</th>
                            <th class="text-center" style="width: 10%;">Acciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($personales as $personal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{route('personal.show',$personal->id)}}">{{$personal->DNI}}</a></td>
                                <td>{{$personal->nombres}}</td>
                                <td>{{$personal->apellidos}}</td>
                                <td>{{$personal->correo}}</td>
                                <td>{{$personal->Rol->descripcion}}</td>
                                <td class="text-center fs-5">
                                    <a href="{{route('personal.edit',$personal->id)}}"
                                       class="button text-secondary">🖉
                                    </a>
                                    <form action="{{route('personal.destroy',$personal->id)}}" method="POST"
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
                                                <input type="text" class="form-control" value="{{$personal_edit->apellidos}}"
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
            @isset($personal_show)
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true"
                     data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle Personal</h1>
                                <a href="{{route('personal.index')}}" type="button" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body fs-6">
                                <p><b> DNI:</b> {{$personal_show->DNI}} </p>
                                <p><b>Nombres: </b>{{$personal_show->nombres}}</p>
                                <p><b>Apellidos: </b>{{$personal_show->apellidos}}</p>
                                <p><b>Correo: </b>{{$personal_show->correo}}</p>
                                <p><b>Usuario: </b>{{$personal_show->usuario}}</p>
                                <p><b>Rol: </b>{{$personal_show->Rol->nombre}}</p>
                            </div>
                            <div class="modal-footer">
                                <p>Creado: {{$personal_show->created_at}} /
                                    Actualizado: {{$personal_show->updated_at}}</p>
                            </div>
                            <div>
                                <div class="modal-footer fs-5 ">
                                    <a href="{{route('personal.edit',$personal_show->id)}}"
                                       class=" link-primary">Editar
                                    </a>
                                    <form action="{{route('personal.destroy',$personal_show->id)}}" method="POST"
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
        @endif


    </div>

@stop
