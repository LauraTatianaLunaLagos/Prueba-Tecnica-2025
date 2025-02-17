@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Cargo</h1>
    
    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nombre del Cargo</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
    </form>
</div>
@endsection
