@extends('panel')
@section('contenido')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion Sectores</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a href="{{route('subsector.index')}}" class="nav-link {{active('subsector')}}">Sub Sector</a>
            <a href="{{route('sector.index')}}" class="nav-link {{active('subsector/sector')}} ">Sector</a>
        </div>
    </nav>


    <div class="tab-content" id="nav-tabContent">
        @yield('subsector_contenido')
        @if(isset($subSectores))
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                 tabindex="0">
                <div class="text-end p-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                        &#43; Nuevo Sub Sector
                    </button>
                </div>
                <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1"
                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Sub Sector</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-4" method="POST" action="{{route('subsector.store')}}">
                                    @csrf
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label ">Lugar(*)</label>
                                                <input type="text" class="form-control"
                                                       name="lugar" {{old('lugar')}}>
                                                {!!$errors->first('lugar','<div class="invalid-feedback d-block">:message</div>')!!}
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
                                                <label for="inputEmail4" class="form-label ">Dirección(*)</label>
                                                <input type="text" class="form-control"
                                                       name="direccion" {{old('direccion')}}>
                                                {!!$errors->first('direccion','<div class="invalid-feedback d-block">:message</div>')!!}
                                            </div>

                                            <div class="col-md-12">
                                                <label for="inputdecripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control w-100" rows="1"
                                                          name="descripcion">{{old('descripcion')}}</textarea>
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

                <form class="col-md-4 p-2" method="POST" id="subsectorBuscar" action="subsector/buscar">
                    @csrf
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Buscar"
                               name="lugar" onkeypress="subsectorBuscar(this)"/>
                    </div>
                    <div class="list-group position-absolute " id="listasubsec">
                    </div>
                </form>
                <script>
                    function subsectorBuscar(e) {
                        const xmr = new XMLHttpRequest();
                        const formData = new FormData(document.getElementById('subsectorBuscar'));
                        const listadni = document.getElementById('listasubsec')
                        xmr.open("POST", 'subsector/buscar', true);
                        xmr.send(formData);
                        xmr.onreadystatechange = function () {
                            if (this.readyState === 4 && this.status === 200) {
                                const subsector = JSON.parse(this.responseText);
                                let alist = '';
                                subsector.forEach(subc => alist +=
                                    '<a href="/subsector/' + subc.id + '" class="list-group-item list-group-item-action">' + subc.lugar + ' ' + subc.direccion  + '</a>');
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
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Lugar</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Dirección</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Descripción</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Sector</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
                            <th class="text-center" style="width: 10%;">Acciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subSectores as $subSector)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{route('subsector.show',$subSector->id)}}">{{$subSector->lugar}}</a></td>
                                <td>{{$subSector->direccion}}</td>
                                <td>{{$subSector->descripcion}}</td>
                                <td>{{$subSector->Sector->nombre}}</td>
                                <td>{{$subSector->estado}}</td>
                                <td class="text-center fs-5">
                                    <a href="{{route('subsector.edit',$subSector->id)}}"
                                       class="button text-secondary">🖉
                                    </a>
                                    <form action="{{route('subsector.destroy',$subSector->id)}}" method="POST"
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
            @isset($subSector_edit)
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true"
                     data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Sub Sector</h1>
                                <a href="{{route('subsector.index')}}" type="button" class="btn-close"
                                   aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('subsector.update',$subSector_edit->id)}}" method="POST">
                                    {!! method_field('PUT') !!}
                                    @csrf
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label ">Lugar(*)</label>
                                                <input type="text" class="form-control"
                                                       value="{{$subSector_edit->lugar}}"
                                                       name="lugar" {{old('lugar')}}>
                                                {!!$errors->first('lugar','<div class="invalid-feedback d-block">:message</div>')!!}

                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Rol</label>
                                                <select class="form-select" name="sector_id">
                                                    @foreach($sectores as $sector)
                                                        <option
                                                            value="{{$sector->id}}" {{$subSector_edit->sector_id==$sector->id?'selected':''}}>{{$sector->nombre}}</option>
                                                    @endforeach
                                                </select>
                                                {!!$errors->first('sector_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label ">Direccion(*)</label>
                                                <input type="text" class="form-control"
                                                       value="{{$subSector_edit->direccion}}"
                                                       name="direccion" {{old('direccion')}}>
                                                {!!$errors->first('direccion','<div class="invalid-feedback d-block">:message</div>')!!}
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputdecripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control w-100" rows="2"
                                                          name="descripcion">{{$subSector_edit->descripcion}}</textarea>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <a href="{{route('subsector.index')}}" type="button"
                                           class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            @endisset
            @isset($subSector_show)
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true"
                     data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle Sub Sector</h1>
                                <a href="{{route('subsector.index')}}" type="button" class="btn-close"
                                   aria-label="Close"></a>
                            </div>
                            <div class="modal-body fs-6">
                                <p><b>Lugar:</b> {{$subSector_show->lugar}} </p>
                                <p><b>Direccion: </b>{{$subSector_show->direccion}}</p>
                                <p><b>Sector: </b>{{$subSector_show->Sector->nombre}}</p>
                                <p><b>Descripcion: </b>{{$subSector_show->descripcion}}</p>
                            </div>
                            <div class="modal-footer">
                                <p>Creado: {{$subSector_show->created_at}} /
                                    Actualizado: {{$subSector_show->updated_at}}</p>
                            </div>
                            <div>
                                <div class="modal-footer fs-5 ">
                                    <a href="{{route('subsector.edit',$subSector_show->id)}}"
                                       class=" link-primary">Editar
                                    </a>
                                    <form action="{{route('subsector.destroy',$subSector_show->id)}}" method="POST"
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
