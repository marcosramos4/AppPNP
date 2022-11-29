@extends('subsector')
@section('subsector_contenido')
    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-contact-tab"
         tabindex="0">
        <h1 class="h4 text-secondary">Registro de Sector</h1>
        <form class="row g-4" method="POST" action="{{route('sector.store')}}">
            @csrf
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Sector(*)</label>
                <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                {!!$errors->first('nombre','<div class="invalid-feedback d-block">:message</div>')!!}
            </div>
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">Cordenadas(*)</label>
                <input type="text" class="form-control" name="cordenadas" value="{{old('cordenadas')}}">
                {!!$errors->first('cordenadas','<div class="invalid-feedback d-block">:message</div>')!!}
            </div><div class="col-md-4">
                <label for="inputEmail4" class="form-label">Descripcion(*)</label>
                <input type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}">
                {!!$errors->first('descripcion','<div class="invalid-feedback d-block">:message</div>')!!}
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
                    <th style="width:5%;">ID</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Sector</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Cordenadas</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Descripción</th>
                    <th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
                    <th class="text-center" style="width: 5%;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sectores as $sector)
                    <tr>
                        <td>{{$sector->id}}</td>
                        <td>{{$sector->nombre}}</td>
                        <td>{{$sector->cordenadas}}</td>
                        <td>{{$sector->descripcion}}</td>
                        <td>{{$sector->estado}}</td>
                        <td class="text-center fs-5">
                            <a href="{{route('sector.edit',$sector->id)}}"
                               class="button text-secondary">🖉
                            </a>
                            <form action="{{route('sector.destroy',$sector->id)}}" method="POST"
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
    @isset($sector_edit)
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
             data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Sector</h1>
                        <a href="{{route('sector.index')}}" type="button" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('sector.update',$sector_edit->id)}}" method="POST">
                            {!! method_field('PUT') !!}
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="recipient-name" class="form-label">Sector(*)</label>
                                    <input type="text" class="form-control" name="nombre"
                                           value="{{$sector_edit->nombre}}">
                                    {!!$errors->first('nombre','<div class="invalid-feedback d-block">:message</div>')!!}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Cordenadas</label>
                                <textarea class="form-control"
                                          name="cordenadas">{{$sector_edit->cordenadas}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripción</label>
                                <textarea class="form-control"
                                          name="descripcion">{{$sector_edit->descripcion}}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="{{route('sector.index')}}" type="button" class="btn btn-secondary">Cancelar</a>
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
