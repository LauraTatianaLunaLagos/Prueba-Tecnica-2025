@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Empleado</h1>
    
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Identificación</label>
            <input type="text" name="identification" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label>País</label>
            <select name="country_id" id="country" class="form-control" required>
                <option value="">-- Seleccionar --</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Ciudad</label>
            <select name="city_id" id="city" class="form-control" required>
                <option value="">-- Selecciona un país primero --</option>
            </select>
        </div>

        <div class="form-group">
            <label>Jefe Inmediato</label>
            <select name="boss_id" class="form-control">
                <option value="">-- Seleccionar --</option>
                @foreach ($bosses as $boss)
                    <option value="{{ $boss->id }}">{{ $boss->first_name }} {{ $boss->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Cargos</label>
            <select name="positions[]" class="form-control" multiple>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
    </form>
</div>

<!-- cargar ciudades segun pais seleccionado -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('country').addEventListener('change', function () {
        let countryId = this.value;
        let citySelect = document.getElementById('city');

        citySelect.innerHTML = '<option value="">Cargando ciudades...</option>';

        fetch(`/get-cities/${countryId}`)
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">-- Seleccionar Ciudad --</option>';
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            })
            .catch(error => console.error('Error al cargar ciudades:', error));
    });
});
</script>

@endsection
