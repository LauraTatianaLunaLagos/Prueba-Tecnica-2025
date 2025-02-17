<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    
    public function index()
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:positions',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')->with('success', 'Cargo creado correctamente');
    }

    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => "required|unique:positions,name,$position->id",
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success', 'Cargo actualizado correctamente');
    }

    public function delete(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Cargo eliminado correctamente');
    }
}
