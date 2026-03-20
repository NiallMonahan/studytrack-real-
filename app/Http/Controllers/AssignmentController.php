<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Module;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('module')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('assignments.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id'   => 'required|exists:modules,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_at'      => 'nullable|date',
        ]);

        Assignment::create($request->only('module_id', 'title', 'description', 'due_at'));

        return redirect()->route('assignments.index')->with('success', 'Assignment created.');
    }

    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        $modules = Module::all();
        return view('assignments.edit', compact('assignment', 'modules'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'module_id'   => 'required|exists:modules,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_at'      => 'nullable|date',
        ]);

        $assignment->update($request->only('module_id', 'title', 'description', 'due_at'));

        return redirect()->route('assignments.index')->with('success', 'Assignment updated.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment deleted.');
    }
}
