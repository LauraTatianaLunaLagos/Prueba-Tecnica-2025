@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Empleado</h1>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mb-3">Volver a la lista</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
            <p><strong>Identificación:</strong> {{ $employee->identification }}</p>
            <p><strong>Dirección:</strong> {{ $employee->address }}</p>
            <p><strong>Teléfono:</strong> {{ $employee->phone }}</p>
            <p><strong>País:</strong> {{ $employee->city->country->name }}</p>
            <p><strong>Ciudad:</strong> {{ $employee->city->name }}</p>
            <p><strong>Jefe Inmediato:</strong> 
                {{ $employee->boss ? $employee->boss->first_name . ' ' . $employee->boss->last_name : 'No tiene' }}
            </p>
            <p><strong>Cargos:</strong> 
                @foreach ($employee->positions as $position)
                    {{ $position->name }}@if (!$loop->last), @endif
                @endforeach
            </p>
        </div>
    </div>
</div>
@endsection
