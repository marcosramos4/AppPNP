@extends('panel')
@section('contenido')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion Patrulleros</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <?php
    function activeSubMenu($url)
    {
        return request()->is($url) ? 'active' : '';
    }
    ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a href="/patrullero" class="nav-link {{activeSubMenu('patrullero')}}">Patrulleros</a>
            <a href="/patrullero/vehiculo" class="nav-link {{activeSubMenu('patrullero/vehiculo')}}">Vehículos</a>
            <a href="/patrullero/estado" class="nav-link {{activeSubMenu('patrullero/estado')}}">Estados</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        @yield('patrullero_contenido')
        @if(isset($patrulleros))
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                 tabindex="0">
                <h1 class="h4 text-secondary">Registro de Patrullero</h1>
                <form class="row g-4" method="POST" action="{{route('patrullero.store')}}">
                    @csrf
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="form-label ">Placa(*)</label>
                                        <input type="text" class="form-control" id="inputplaca"
                                               name="placa" {{old('placa')}}>
                                        {!!$errors->first('placa','<div class="invalid-feedback d-block">:message</div>')!!}
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="form-label">Vehículo</label>
                                        <select class="form-select" name="vehiculo_id">
                                            @foreach($vehiculos as $vehiculo)
                                                <option value="{{$vehiculo->id}}">{{$vehiculo->vehiculo}}</option>
                                            @endforeach
                                        </select>
                                        {!!$errors->first('vehiculo_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="form-label">Estado</label>
                                        <select class="form-select" name="estado_id">
                                            @foreach($estados as $estado)
                                                <option value="{{$estado->id}}">{{$estado->estado}}</option>
                                            @endforeach
                                        </select>
                                        {!!$errors->first('estado_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="inputdecripcion" class="form-label">Descripción</label>
                                <textarea class="form-control w-100" rows="1"
                                          name="descripcion">{{old('descripcion')}}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary mb-3 ">Guardar</button>
                    </div>
                </form>
                <form class="col-md-4">
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                               aria-describedby="search-addon"/>
                        <button type="button" class="btn btn-outline-primary">Buscar</button>
                    </div>
                </form>
                <br>
                <div class="box-typical box-typical-padding">
                    <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

                        <thead>
                        <tr class="text-secondary">
                            <th style="width: 5%;">N°</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Placa</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Vehículo</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Descripción</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Editado</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
                            <th class="text-center" style="width: 10%;">Acciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patrulleros as $patrullero)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{route('patrullero.show',$patrullero->id)}}">{{$patrullero->placa}}</a></td>
                                <td>{{$patrullero->Vehiculo->vehiculo}}</td>
                                <td>{{$patrullero->descripcion}}</td>
                                <td>{{$patrullero->updated_at}}</td>
                                <td>{{$patrullero->Estado->estado}}</td>
                                <td class="text-center fs-5">
                                    <a href="{{route('patrullero.edit',$patrullero->id)}}"
                                       class="button text-secondary">🖉
                                    </a>
                                    <form action="{{route('patrullero.destroy',$patrullero->id)}}" method="POST"
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
            @isset($patrullero_edit)
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true"
                     data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Patrullero</h1>
                                <a href="/patrullero" type="button" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('patrullero.update',$patrullero_edit->id)}}" method="POST">
                                    {!! method_field('PUT') !!}
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="recipient-name" class="form-label">Placa(*)</label>
                                            <input type="text" class="form-control" name="placa"
                                                   value="{{$patrullero_edit->placa}}">
                                            {!!$errors->first('placa','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputEmail4" class="form-label">Vehículo</label>
                                            <select class="form-select" name="vehiculo_id">
                                                @foreach($vehiculos as $vehiculo)
                                                    <option
                                                        value="{{$vehiculo->id}}" {{$patrullero_edit->Vehiculo->id==$vehiculo->id?'selected':''}}>{{$vehiculo->vehiculo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputEmail4" class="form-label">Estado</label>
                                            <select class="form-select" name="estado_id">
                                                @foreach($estados as $estado)
                                                    <option
                                                        value="{{$estado->id}}" {{$patrullero_edit->estado->id==$estado->id?'selected':''}}>{{$estado->estado}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Descripcion</label>
                                        <textarea class="form-control"
                                                  name="descripcion">{{$patrullero_edit->descripcion}}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/patrullero" type="button" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            @endisset
            @isset($patrullero_show)
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true"
                     data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle Patrullero</h1>
                                <a href="/patrullero" type="button" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body fs-6">
                                <p><b> PLACA:</b> {{$patrullero_show->placa}} </p>
                                <p><b>Vehiculo: </b>{{$patrullero->Vehiculo->vehiculo}}<br>
                                    {{$patrullero->Vehiculo->descripcion}}
                                </p>
                                <p><b>Estado: </b>{{$patrullero->Estado->estado}}<br>
                                    {{$patrullero->Estado->descripcion}}
                                </p>
                                <p class=" fw-bold">Descripción:</p>
                                <p>{{$patrullero_show->Descripcion}}</p>
                            </div>
                            <div class="modal-footer">
                                <p>Creado: {{$patrullero_show->created_at}} / Actualizado: {{$patrullero_show->updated_at}}</p>

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
