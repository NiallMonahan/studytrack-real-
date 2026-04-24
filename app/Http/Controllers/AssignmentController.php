<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Module;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('module')->get();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('attendances.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'student_name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        Attendance::create($request->only('module_id', 'student_name', 'date', 'status'));

        return redirect()->route('attendances.index')->with('success', 'Attendance created.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $modules = Module::all();
        return view('attendances.edit', compact('attendance', 'modules'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'student_name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance->update($request->only('module_id', 'student_name', 'date', 'status'));

        return redirect()->route('attendances.index')->with('success', 'Attendance updated.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance deleted.');
    }
}