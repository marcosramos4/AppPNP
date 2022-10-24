@extends('panel')
@section('contenido')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-secondary">Gestion de Patrulleros</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Patrulleros
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Categorias
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
            <form class="row g-4">
                <div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Placa</label>
                            <input type="email" class="form-control" id="inputplaca">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Categoría</label>
                            <select class="form-select" id="specificSizeSelect">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Estado</label>
                            <select class="form-select" id="specificSizeSelect">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="inputdecripcion" class="form-label">Descripción</label>
                    <textarea class="form-control w-100" rows="1"></textarea>
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
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Descripción</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Registrado</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Editado</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
                        <th class="text-center" style="width: 5%;">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
                        <td>Linus</td>
                        <td>Linus</td>
                        <td>Linus</td>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
                        <td>Linus</td>
                        <td>Linus</td>
                        <td>Linus</td>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
                        <td>Linus</td>
                        <td>Linus</td>
                        <td>Linus</td>
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
                    </tbody>
                </table>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <h1 class="h4 text-secondary">Registro de Categoria</h1>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
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
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
            <h1 class="h4 text-secondary">Registro de Estado</h1>
            <form class="row g-4">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="inputvehiculo" name="estado">
                </div>
                <div>
                    <label for="inputdecripcion" class="form-label">Descripción</label>
                    <textarea class="form-control w-100" rows="1" name="descripcion"></textarea>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
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
                    <tr>
                        <td>Emil</td>
                        <td>Tobias</td>
                        <td>Linus</td>
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
