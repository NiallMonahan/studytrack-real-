<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Models\Assignment;
use App\Models\Module;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $moduleCount = Module::count();
    $assignmentCount = Assignment::count();

    $upcoming = Assignment::whereNotNull('due_at')
        ->where('due_at', '>=', now())
        ->orderBy('due_at')
        ->with('module')
        ->take(5)
        ->get();

    return view('dashboard', compact('moduleCount', 'assignmentCount', 'upcoming'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('modules', ModuleController::class);
    Route::resource('assignments', AssignmentController::class);
    Route::resource('attendances', AttendanceController::class);
});

require __DIR__ . '/auth.php';