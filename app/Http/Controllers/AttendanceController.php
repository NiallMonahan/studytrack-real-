<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Module;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = auth()->user()->attendances()->with('module')->orderBy('date', 'desc')->get();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $modules = auth()->user()->modules;
        return view('attendances.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        Attendance::create(array_merge($request->only('module_id', 'date', 'status'), [
            'user_id' => auth()->id(),
        ]));

        return redirect()->route('attendances.index')->with('success', 'Attendance recorded.');
    }

    public function show(Attendance $attendance)
    {
        abort_if($attendance->user_id !== auth()->id(), 403);
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        abort_if($attendance->user_id !== auth()->id(), 403);
        $modules = auth()->user()->modules;
        return view('attendances.edit', compact('attendance', 'modules'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        abort_if($attendance->user_id !== auth()->id(), 403);

        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance->update($request->only('module_id', 'date', 'status'));

        return redirect()->route('attendances.index')->with('success', 'Attendance updated.');
    }

    public function destroy(Attendance $attendance)
    {
        abort_if($attendance->user_id !== auth()->id(), 403);
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance deleted.');
    }
}
