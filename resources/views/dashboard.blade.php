<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome Banner --}}
            <div class="bg-violet-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Welcome back, {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Here's a summary of your study progress.</p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-violet-100 dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $moduleCount }}</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Modules</p>
                    <a href="{{ route('modules.index') }}"
                        class="mt-4 inline-block px-4 py-2 bg-violet-400 text-white rounded hover:bg-violet-500 text-sm">View
                        Modules</a>
                </div>
                <div class="bg-violet-100 dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $assignmentCount }}</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Assignments</p>
                    <a href="{{ route('assignments.index') }}"
                        class="mt-4 inline-block px-4 py-2 bg-violet-400 text-white rounded hover:bg-violet-500 text-sm">View
                        Assignments</a>
                </div>
            </div>

            {{-- Attendance Rate --}}
            <div class="bg-violet-100 dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Overall Attendance</h3>
                    <span class="text-sm font-medium {{ $attendanceRate >= 80 ? 'text-green-600' : ($attendanceRate >= 60 ? 'text-yellow-500' : 'text-red-600') }}">
                        {{ $attendanceRate }}%
                    </span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                    <div class="h-3 rounded-full {{ $attendanceRate >= 80 ? 'bg-green-500' : ($attendanceRate >= 60 ? 'bg-yellow-400' : 'bg-red-500') }}"
                        style="width: {{ $attendanceRate }}%"></div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    {{ $attendancePresent }} of {{ $attendanceTotal }} classes attended across all modules
                </p>
                <a href="{{ route('attendances.index') }}"
                    class="mt-3 inline-block px-4 py-2 bg-violet-400 text-white rounded hover:bg-violet-500 text-sm">
                    View Attendance
                </a>
            </div>

            {{-- Upcoming Assignments --}}
            <div class="bg-violet-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Upcoming Assignments</h3>

                @if($upcoming->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No upcoming assignments. You're all caught up!</p>
                @else
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($upcoming as $assignment)
                                    <li class="py-3 flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $assignment->title }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $assignment->module->code }} —
                                                {{ $assignment->module->title }}
                                            </p>
                                        </div>
                                        <span class="text-sm font-medium px-3 py-1 rounded-full
                                                                    {{ \Carbon\Carbon::parse($assignment->due_at)->diffInDays(now()) <= 3
                            ? 'bg-red-100 text-red-600'
                            : 'bg-blue-100 text-blue-600' }}">
                                            {{ \Carbon\Carbon::parse($assignment->due_at)->format('d M Y') }}
                                        </span>
                                    </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>