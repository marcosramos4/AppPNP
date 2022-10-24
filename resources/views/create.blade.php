<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Patrulleros data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('patrulleros.store') }}">
          <!--div class="form-group">
              @csrf
              <label for="country_name">Patrulleros Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div-->
          <div class="form-group">
            @csrf
              <label for="cases">Placa de Patrullero :</label>
              <input type="text" class="form-control" name="placa"/>
          </div>
          <div class="form-group">
              <label for="cases">Descripción de Patrullero :</label>
              <input type="text" class="form-control" name="descripcion"/>
          </div>
          <div class="form-group">
              <label for="cases">Estado Patrullero :</label>
              <input type="text" class="form-control" name="estado"/>
          </div>

          <button type="submit" class="btn btn-primary">Añadir Patrullero</button>
      </form>
  </div>
</div>
@endsection