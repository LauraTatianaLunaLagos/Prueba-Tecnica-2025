@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Cargos</h1>
    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Agregar Cargo</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nombre del Cargo</th>
                <th>Empleados en este Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($positions as $position)
            <tr>
                <td>{{ $position->name }}</td>
                <td>
                    @if($position->employees->count() > 0)
                        @foreach ($position->employees as $employee)
                            {{ $employee->first_name }} {{ $employee->last_name }}@if(!$loop->last), @endif
                        @endforeach
                    @else
                        No hay empleados asignados.
                    @endif
                </td>
                <td>
                    <a href="{{ route('positions.show', $position) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('positions.edit', $position) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('positions.destroy', $position) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
