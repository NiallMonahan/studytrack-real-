<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = auth()->user()->modules()->with('assignments')->get();
        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        return view('modules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Module::create(array_merge($request->only('code', 'title', 'description'), [
            'user_id' => auth()->id(),
        ]));

        return redirect()->route('modules.index')->with('success', 'Module created.');
    }

    public function show(Module $module)
    {
        abort_if($module->user_id !== auth()->id(), 403);
        return view('modules.show', compact('module'));
    }

    public function edit(Module $module)
    {
        abort_if($module->user_id !== auth()->id(), 403);
        return view('modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        abort_if($module->user_id !== auth()->id(), 403);

        $request->validate([
            'code' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module->update($request->only('code', 'title', 'description'));

        return redirect()->route('modules.index')->with('success', 'Module updated.');
    }

    public function destroy(Module $module)
    {
        abort_if($module->user_id !== auth()->id(), 403);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted.');
    }
}
