@extends('patrullero')
@section('patrullero_contenido')
    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
         tabindex="0">
        <h1 class="h4 text-secondary">Registro de Vehículo</h1>
        <form class="row g-4" method="POST" action="{{route('vehiculo.store')}}">
            @csrf
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Vehículo(*)</label>
                <input type="text" class="form-control" id="inputvehiculo" name="vehiculo" value="{{old('vehiculo')}}">
                    {!!$errors->first('vehiculo','<div class="invalid-feedback d-block">:message</div>')!!}
            </div>
            <div>
                <label for="inputdecripcion" class="form-label">Descripción</label>
                <textarea class="form-control w-100" rows="1" name="descripcion">{{old('descripcion')}}</textarea>
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
                @foreach($vehiculos as $vehiculo)
                    <tr>
                        <td>{{$vehiculo->id}}</td>
                        <td>{{$vehiculo->vehiculo}}</td>
                        <td>{{$vehiculo->descripcion}}</td>
                        <td class="text-center fs-5">
                            <a href="{{route('vehiculo.edit',$vehiculo->id)}}"
                               class="button text-secondary">🖉
                            </a>
                            <form action="{{route('vehiculo.destroy',$vehiculo->id)}}" method="POST"
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
    @isset($vehiculo_edit)
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Vehiculo</h1>
                        <a href="/patrullero/vehiculo" type="button" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('vehiculo.update',$vehiculo_edit->id)}}" method="POST">
                            {!! method_field('PUT') !!}
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="recipient-name" class="form-label">Vehículo(*)</label>
                                    <input type="text" class="form-control" name="vehiculo"
                                           value="{{$vehiculo_edit->vehiculo}}">
                                    {!!$errors->first('vehiculo','<div class="invalid-feedback d-block">:message</div>')!!}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripción</label>
                                <textarea class="form-control"
                                          name="descripcion">{{$vehiculo_edit->descripcion}}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="/patrullero/vehiculo" type="button" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script>

            window.addEventListener('load', function () {

                const myModal = new bootstrap.Modal('#myModal', {
                    keyboard: true
                });
                myModal.show();
            });

        </script>
    @endisset
@stop
