@extends('subsector')
@section('subsector_contenido')
    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-contact-tab"
         tabindex="0">
        <div class="text-end p-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                &#43; Nuevo Sector
            </button>
        </div>
        <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de Personal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1 class="h4 text-secondary">Registro de Sector</h1>
                        <form class="row g-4" method="POST" action="{{route('sector.store')}}">
                            @csrf
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label">Sector(*)</label>
                                <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                                {!!$errors->first('nombre','<div class="invalid-feedback d-block">:message</div>')!!}
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label">Descripcion(*)</label>
                                <input type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}">
                                {!!$errors->first('descripcion','<div class="invalid-feedback d-block">:message</div>')!!}
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label">Color(*)</label>
                                <input type="color" class="form-control" name="color" value="{{old('color')}}">
                                {!!$errors->first('color','<div class="invalid-feedback d-block">:message</div>')!!}
                            </div>

                            <div class="col-md-4">
                                <input type="hidden" id="cordenadas" class="form-control" name="cordenadas" value="{{old('cordenadas')}}">
                                {!!$errors->first('cordenadas','<div class="invalid-feedback d-block">:message</div>')!!}
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
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
                        <button onclick="dibujar()" class="btn btn-warning ">Trazar Mapa</button>

                        <div id="map" style="height: 500px; width: 100%"></div>
                        <script>
                            var map = L.map('map').setView([-16.39953, -71.535823], 13);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);
                            const freeDraw = new FreeDraw({mode: FreeDraw.ALL});
                            function dibujar(){
                                map.addLayer(freeDraw);

                            }
                            function quitar(){
                                map.remove(freeDraw);
                            }
                            freeDraw.on('markers', event => {
                                var cordenadas=event.latLngs.toString().replaceAll('LatLng(','[').replaceAll(')',']');
                                console.log(cordenadas);
                                document.getElementById('cordenadas').value =cordenadas;
                            });

                        </script>
                    </div>
                </div>
            </div>
        </div>

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
