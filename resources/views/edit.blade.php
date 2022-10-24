@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Patrulleros Data
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
      <form method="post" action="{{ route('patrulleros.update', $patrulleros->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Placa:</label>
              <input type="text" class="form-control" name="placa" value="{{ $patrulleros->placa }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Descripción :</label>
              <input type="text" class="form-control" name="descripcion" value="{{ $patrulleros->descripcion }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Estado :</label>
              <input type="text" class="form-control" name="estado" value="{{ $patrulleros->estado }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection