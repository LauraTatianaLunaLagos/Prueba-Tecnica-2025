<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function indexAction()
    {
        $employees = Employee::with('positions', 'boss')->get();
        return view('employees.index', compact('employees'));
    }

    public function createAction()
    {
        $positions = Position::all();
        $bosses = Employee::all();
        return view('employees.create', compact('positions', 'bosses'));
    }

    public function storeAction(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification' => 'required|unique:employees',
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'boss_id' => 'nullable|exists:employees,id'
        ]);

        $employee = Employee::create($request->all());
        $employee->positions()->attach($request->positions);

        return redirect()->route('employees.index')->with('success', 'Empleado creado correctamente');
    }

    public function showAction(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function editAction(Employee $employee)
    {
        $positions = Position::all();
        $bosses = Employee::all();
        return view('employees.edit', compact('employee', 'positions', 'bosses'));
    }

    public function updateAction(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'identification' => "required|unique:employees,identification,$employee->id",
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'boss_id' => 'nullable|exists:employees,id'
        ]);

        $employee->update($request->all());
        $employee->positions()->sync($request->positions);

        return redirect()->route('employees.index')->with('success', 'Empleado actualizado correctamente');
    }

    public function deleteAction(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado correctamente');
    }
}
