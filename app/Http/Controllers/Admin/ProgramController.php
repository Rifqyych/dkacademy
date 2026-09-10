<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('Admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('Admin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|max:50',
        ]);

        Program::create($request->all());

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan!');
    }

    public function edit(Program $program)
    {
        return view('Admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'nama_program' => 'required|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|max:50',
        ]);

        $program->update($request->all());

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus!');
    }
}
