@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cargo</h1>
    
    <form action="{{ route('positions.update', $position) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Nombre del Cargo</label>
            <input type="text" name="name" class="form-control" value="{{ $position->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>
@endsection
