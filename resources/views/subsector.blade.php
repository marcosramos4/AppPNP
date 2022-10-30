@extends('sector')
@section('sector_contenido')
    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
         tabindex="0">
        <h1 class="h4 text-secondary">Registro de Subsectores</h1>
        <form class="row g-4" method="POST" action="{{route('')}}">
            @csrf
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Subsector</label>
                <input type="text" class="form-control" id="inputsubsector" name="subsector" value="{{old('subsector')}}">
                {!!$errors->first('subsector','<div class="invalid-feedback d-block">:message</div>')!!}
            </div>
            <div>
                <label for="inputdirección" class="form-label">Dirección</label>
                <textarea class="form-control w-100" rows="1" name="direccion">{{old('direccion')}}</textarea>
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
                    <th class="d-none d-sm-table-cell" style="width: 10%;">Subsector</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Direccion</th>
                    <th class="text-center" style="width: 5%;">Acciones</th>

                </tr>
                </thead>
                <tbody>
                @isset($subsector_edit)
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                         data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Subsector</h1>
                                    <a href="/sector/subsector" type="button" class="btn-close" aria-label="Close"></a>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        {!! method_field('PUT') !!}
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="recipient-name" class="form-label">Subsector</label>
                                                <input type="text" class="form-control" name="vehiculo">
                                                {!!$errors->first('subsector','<div class="invalid-feedback d-block">:message</div>')!!}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Dirección</label>
                                            <textarea class="form-control"
                                                      name="direccion">{{$subsector_edit->direccion}}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="/sector/subsector" type="button" class="btn btn-secondary">Cancelar</a>
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
