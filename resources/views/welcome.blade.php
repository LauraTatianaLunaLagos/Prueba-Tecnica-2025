@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="mt-5 fw-bold text-primary">Sistema de Gestión de Empleados</h1>
    <p class="lead text-muted">Administra empleados, cargos y jerarquías de manera eficiente.</p>

    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="100" class="mb-3">
                    <h3 class="fw-bold text-dark">Gestión de Empleados</h3>
                    <p class="text-muted">Agrega, edita y visualiza la información de los empleados.</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-primary w-100 py-2">Ir a Empleados</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" width="100" class="mb-3">
                    <h3 class="fw-bold text-dark">Gestión de Cargos</h3>
                    <p class="text-muted">Administra los distintos cargos dentro de la organización.</p>
                    <a href="{{ route('positions.index') }}" class="btn btn-success w-100 py-2">Ir a Cargos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
