@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Empleado</h1>
    
    <form action="{{ route('employees.update', $employee) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
        </div>
        <div class="form-group">
            <label>Identificación</label>
            <input type="text" name="identification" class="form-control" value="{{ $employee->identification }}" required>
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ $employee->address }}" required>
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" required>
        </div>
        <div class="form-group">
            <label>País</label>
            <input type="text" name="country" class="form-control" value="{{ $employee->country }}" required>
        </div>
        <div class="form-group">
            <label>Ciudad</label>
            <input type="text" name="city" class="form-control" value="{{ $employee->city }}" required>
        </div>
        <div class="form-group">
            <label>Jefe Inmediato</label>
            <select name="boss_id" class="form-control">
                <option value="">-- Seleccionar --</option>
                @foreach ($bosses as $boss)
                    <option value="{{ $boss->id }}" {{ $employee->boss_id == $boss->id ? 'selected' : '' }}>
                        {{ $boss->first_name }} {{ $boss->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Cargos</label>
            <select name="positions[]" class="form-control" multiple>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ $employee->positions->contains($position->id) ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>
@endsection
