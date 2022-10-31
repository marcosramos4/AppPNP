@extends('panel')
@section('contenido')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion Sectores</h1>
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
            <a href="/sector" class="nav-link {{activeSubMenu('sector')}}">Sector</a>
            <a href="/sector/subsector" class="nav-link {{activeSubMenu('sector/subsector')}}">Subsector</a>
            <a href="/sector/estadosector" class="nav-link {{activeSubMenu('sector/estadosector')}}">Estados</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                 tabindex="0">
                <h1 class="h4 text-secondary">Registro de Sectores</h1>
                <form class="row g-4" method="POST" action="{{route('sector.store')}}">

                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="form-label ">Sector</label>
                                        <input type="text" class="form-control" id="inputsector"
                                               name="sector" {{old('sector')}}>
                                        {!!$errors->first('sector','<div class="invalid-feedback d-block">:message</div>')!!}
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="form-label">Subsector</label>
                                        <select class="form-select" name="subsector_id">

                                        </select>
                                        {!!$errors->first('subsector_id','<div class="invalid-feedback d-block">:message</div>')!!}

                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail4" class="form-label">Estado</label>
                                        <select class="form-select" name="estado_id">

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
                <form class="col-md-4" method="POST" id="sectorBuscar" action="sector/buscar">
                    @csrf
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Buscar"
                               name="sector" onkeypress="buscar(this)"/>
                    </div>
                    <div class="list-group position-absolute " id="listaSector">
                    </div>
                </form>
                <script>
                    function buscar(e){
                        console.log(e.value);
                        const xmr = new XMLHttpRequest();
                        const formData = new FormData(document.getElementById('sectorBuscar'));
                        const listaSector=document.getElementById('listasector')
                        xmr.open("POST", 'sector/buscar', true);
                        xmr.send(formData);
                        xmr.onreadystatechange = function () {
                            if (this.readyState === 4 && this.status === 200) {
                                const sectores =JSON.parse(this.responseText);
                                let alist='';
                                sectores.forEach(patru=> alist+=
                                    '<a href="/sector/'+patru.id+'" class="list-group-item list-group-item-action">'+patru.sector+'</a>' );
                                listaSector.innerHTML=alist;

                            }
                        };

                    }

                </script>
                <br>
                <div class="box-typical box-typical-padding">
                    <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

                        <thead>
                        <tr class="text-secondary">
                            <th style="width: 5%;">N°</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Sector</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Subsector</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Descripción</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Editado</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
                            <th class="text-center" style="width: 10%;">Acciones</th>

                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

            </div>
            @isset($sector_edit)
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true"
                     data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Sector</h1>
                                <a href="/sector" type="button" class="btn-close" aria-label="Close"></a>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('sector.update',$sector_edit->id)}}" method="POST">
                                    {!! method_field('PUT') !!}
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="recipient-name" class="form-label">Sector</label>
                                            <input type="text" class="form-control" name="sector"
                                                   value="{{$sector_edit->sector}}">
                                            {!!$errors->first('sector','<div class="invalid-feedback d-block">:message</div>')!!}
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputEmail4" class="form-label">Subsector</label>

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
                                                  name="descripcion">{{$sectoredit->descripcion}}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/sector" type="button" class="btn btn-secondary">Cancelar</a>
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
        @endif


    </div>

@stop
