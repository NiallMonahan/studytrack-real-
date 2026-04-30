<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $module->code }} — {{ $module->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Module Info --}}
            <div class="bg-violet-100 dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Module Code</span>
                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ $module->code }}</p>
                </div>

                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</span>
                    <p class="text-gray-900 dark:text-gray-100">{{ $module->title }}</p>
                </div>

                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</span>
                    <p class="text-gray-900 dark:text-gray-100">{{ $module->description ?? 'No description provided.' }}</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('modules.edit', $module) }}"
                        class="px-4 py-2 bg-sky-300 text-white rounded hover:bg-sky-400">
                        Edit
                    </a>
                    <a href="{{ route('modules.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Back
                    </a>
                </div>
            </div>

            {{-- Assignments --}}
            <div class="bg-violet-100 dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Assignments</h3>
                    <a href="{{ route('assignments.create') }}"
                        class="px-4 py-2 bg-violet-400 text-white rounded hover:bg-violet-500 text-sm">
                        Add Assignment
                    </a>
                </div>

                @if($module->assignments->isEmpty())
                    <p class="text-gray-500 text-sm">No assignments for this module yet.</p>
                @else
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($module->assignments as $assignment)
                            <li class="py-3 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ $assignment->title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $assignment->due_at ? 'Due: ' . \Carbon\Carbon::parse($assignment->due_at)->format('d M Y') : 'No due date' }}
                                    </p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('assignments.show', $assignment) }}"
                                        class="px-3 py-1 bg-violet-400 text-white rounded hover:bg-violet-500 text-sm">
                                        View
                                    </a>
                                    <a href="{{ route('assignments.edit', $assignment) }}"
                                        class="px-3 py-1 bg-sky-300 text-white rounded hover:bg-sky-400 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('assignments.destroy', $assignment) }}" method="POST"
                                        onsubmit="return confirm('Delete this assignment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-400 hover:text-red-600 text-xl font-bold leading-none" title="Delete">✕</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
