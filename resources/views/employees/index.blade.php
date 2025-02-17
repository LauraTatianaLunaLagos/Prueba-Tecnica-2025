@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Empleados</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Ciudad</th>
                <th>País</th>
                <th>Jefe</th>
                <th>Cargos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->identification }}</td>
                <td>{{ $employee->city->name }}</td>
                <td>{{ $employee->city->country->name }}</td>
                <td>
                    {{ $employee->boss ? $employee->boss->first_name . ' ' . $employee->boss->last_name : 'N/A' }}
                </td>
                <td>
                    @foreach ($employee->positions as $position)
                        {{ $position->name }}@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
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
