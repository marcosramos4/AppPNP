@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Placa</td>
          <td>Descripción</td>
          <td>Estado</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($patrulleros as $patrullero)
        <tr>
            <td>{{$patrullero->id}}</td>
            <td>{{$patrullero->placa}}</td>
            <td>{{$patrullero->descripcion}}</td>
            <td>{{$patrullero->estado}}</td>
            <td><a href="{{ route('patrulleros.edit', $patrullero->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('patrulleros.destroy', $patrullero->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection