<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Module;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = auth()->user()->assignments()->with('module')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $modules = auth()->user()->modules;
        return view('assignments.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_at' => 'nullable|date',
        ]);

        Assignment::create(array_merge($request->only('module_id', 'title', 'description', 'due_at'), [
            'user_id' => auth()->id(),
        ]));

        return redirect()->route('assignments.index')->with('success', 'Assignment created.');
    }

    public function show(Assignment $assignment)
    {
        abort_if($assignment->user_id !== auth()->id(), 403);
        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        abort_if($assignment->user_id !== auth()->id(), 403);
        $modules = auth()->user()->modules;
        return view('assignments.edit', compact('assignment', 'modules'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        abort_if($assignment->user_id !== auth()->id(), 403);

        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_at' => 'nullable|date',
        ]);

        $assignment->update($request->only('module_id', 'title', 'description', 'due_at'));

        return redirect()->route('assignments.index')->with('success', 'Assignment updated.');
    }

    public function destroy(Assignment $assignment)
    {
        abort_if($assignment->user_id !== auth()->id(), 403);
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment deleted.');
    }
}
