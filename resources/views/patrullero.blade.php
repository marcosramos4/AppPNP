@extends('panel')
@section('contenido')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion Patrulleros</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Patrulleros
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Vehículos
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Estados
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
             tabindex="0">
            <h1 class="h4 text-secondary">Registro de Patrullero</h1>
            <form class="row g-4" method="POST" action="{{route('patrullero.store')}}">
                @csrf
                <div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label ">Placa(*)</label>
                            <input type="text" class="form-control" id="inputplaca" name="placa" {{old('placa')}}>
                            {!!$errors->first('placa','<div class="invalid-feedback d-block">:message</div>')!!}
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Vehículo</label>
                            <select class="form-select" id="specificSizeSelect" name="patrullero_categoria_id">
                                @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->vehiculo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Estado</label>
                            <select class="form-select" id="specificSizeSelect" name="patrullero_estado_id">
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->estado}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="inputdecripcion" class="form-label">Descripción</label>
                    <textarea class="form-control w-100" rows="1" name="descripcion" >{{old('descripcion')}}</textarea>
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
                        <th style="width: 5%;">ID</th>
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
                        <td>{{$patrullero->id}}</td>
                        <td>{{$patrullero->placa}}</td>
                        <td>{{$patrullero->PatrulleroCategoria->vehiculo}}</td>
                        <td>{{$patrullero->descripcion}}</td>
                        <td>{{$patrullero->updated_at}}</td>
                        <td>{{$patrullero->PatrulleroEstado->estado}}</td>
                        <td class="text-center">
                            <a href="/patrullero/{{$patrullero->id}}/edit" class="button text-secondary">
                                <svg class="bi pe-none me-2" width="25" height="30">
                                    <use xlink:href="#editar"/>
                                </svg>
                            </a>
                            <a href="" class="button  text-secondary">
                                <svg class="bi pe-none me-2" width="25" height="30">
                                    <use xlink:href="#eliminar"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <h1 class="h4 text-secondary">Registro de Vehículo</h1>
            <form class="row g-4">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Vehículo</label>
                    <input type="text" class="form-control" id="inputvehiculo" name="vehiculo">
                </div>
                <div>
                    <label for="inputdecripcion" class="form-label">Descripción</label>
                    <textarea class="form-control w-100" rows="1"></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary mb-3 ">Guardar</button>
                </div>
            </form>
            <br>
            <div class="box-typical box-typical-padding">
                <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

                    <thead>
                    <tr class="text-secondary">
                        <th style="width: 5%;">N°</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Vehículo</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Descripción</th>
                        <th class="text-center" style="width: 5%;">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>{{$categoria->id}}</td>
                        <td>{{$categoria->vehiculo}}</td>
                        <td>{{$categoria->descripcion}}</td>
                        <td class="text-center">
                            <a href="" class="button text-secondary">
                                <svg class="bi pe-none me-2" width="25" height="30">
                                    <use xlink:href="#editar"/>
                                </svg>
                            </a>
                            <a href="" class="button  text-secondary">
                                <svg class="bi pe-none me-2" width="25" height="30">
                                    <use xlink:href="#eliminar"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
            <h1 class="h4 text-secondary">Registro de Estado</h1>
            <form class="row g-4" method="POST">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Estado(*)</label>
                    <input type="text" class="form-control"  name="estado">
                    {!! $errors->first('estado','<span class="error">:message</span>') !!}
                </div>
                <div>
                    <label for="inputdecripcion" class="form-label">Descripción</label>
                    <textarea class="form-control w-100" rows="1" name="descripcion" value="{{ old('estado')}}"></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary mb-3 ">Guardar</button>
                </div>
            </form>
            <br>
            <div class="box-typical box-typical-padding">
                <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

                    <thead>
                    <tr class="text-secondary">
                        <th style="width:5%;">N°</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Descripción</th>
                        <th class="text-center" style="width: 5%;">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estados as $estado)
                        <tr>
                            <td>{{$estado->id}}</td>
                            <td>{{$estado->estado}}</td>
                            <td>{{$estado->descripcion}}</td>
                            <td class="text-center">
                                <a href="" class="button text-secondary">
                                    <svg class="bi pe-none me-2" width="25" height="30">
                                        <use xlink:href="#editar"/>
                                    </svg>
                                </a>
                                <a href="" class="button  text-secondary">
                                    <svg class="bi pe-none me-2" width="25" height="30">
                                        <use xlink:href="#eliminar"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @isset($patrullero_edit)
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Patrullero</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" >
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Placa(*)</label>
                                <input type="text" class="form-control" id="recipient-name" name="placa" value="{{$patrullero_edit->placa}}">
                                {!!$errors->first('placa','<div class="invalid-feedback d-block">:message</div>')!!}
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripcion</label>
                                <textarea class="form-control" id="message-text">{{$patrullero_edit->descripcion}}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>

        <script>

            window.addEventListener('load', function() {

                const myModal = new bootstrap.Modal('#myModal', {
                    keyboard: true
                });
                myModal.show();
            });

        </script>
    @endisset

@stop
