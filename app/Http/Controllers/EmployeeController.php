<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * lista de empleados
     */
    public function index()
    {
        $employees = Employee::with('positions', 'boss', 'city')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * crear un nuevo empleado
     */
    public function create()
    {
        $positions = Position::all();
        $bosses = Employee::all();
        $countries = Country::all();
        return view('employees.create', compact('positions', 'bosses', 'countries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification' => 'required|unique:employees',
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'boss_id' => 'nullable|exists:employees,id'
        ]);

        // valida que la ciudad pertenece al país seleccionado
        $city = City::findOrFail($request->city_id);
        if ($city->country_id != $request->country_id) {
            return redirect()->back()->withErrors(['city_id' => 'La ciudad seleccionada no pertenece al país elegido.'])->withInput();
        }

        // se crea el empleado
        $employee = Employee::create($request->all());
        $employee->positions()->attach($request->positions);

        return redirect()->route('employees.index')->with('success', 'Empleado creado correctamente');
    }

    /**
     * mostrar un empleado
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * editar empleado
     */
    public function edit(Employee $employee)
    {
        $positions = Position::all();
        $bosses = Employee::all();
        $countries = Country::all();
        $cities = City::where('country_id', $employee->city->country_id)->get(); // Obtener ciudades del país actual

        return view('employees.edit', compact('employee', 'positions', 'bosses', 'countries', 'cities'));
    }

    /**
     * Actualizar empleado
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification' => "required|unique:employees,identification,$employee->id",
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'boss_id' => 'nullable|exists:employees,id'
        ]);

        // valida que la ciudad pertenece al país seleccionado
        $city = City::findOrFail($request->city_id);
        if ($city->country_id != $request->country_id) {
            return redirect()->back()->withErrors(['city_id' => 'La ciudad seleccionada no pertenece al país elegido.'])->withInput();
        }

        // Actualiza empleado
        $employee->update($request->all());
        $employee->positions()->sync($request->positions);

        return redirect()->route('employees.index')->with('success', 'Empleado actualizado correctamente');
    }

    /**
     * eliminar empleado
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado correctamente');
    }

    /**
     * Obtener las ciudades de un país
     */
    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}
