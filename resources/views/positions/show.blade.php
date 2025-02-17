@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Cargo</h1>
    <a href="{{ route('positions.index') }}" class="btn btn-secondary mb-3">Volver a la lista</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $position->name }}</h5>
            <p><strong>Empleados en este cargo:</strong></p>
            <ul>
                @forelse ($position->employees as $employee)
                    <li>{{ $employee->first_name }} {{ $employee->last_name }}</li>
                @empty
                    <p>No hay empleados en este cargo.</p>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
