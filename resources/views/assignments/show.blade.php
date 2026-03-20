<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $assignment->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Module</span>
                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ $assignment->module->code }} — {{ $assignment->module->title }}</p>
                </div>

                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</span>
                    <p class="text-gray-900 dark:text-gray-100">{{ $assignment->title }}</p>
                </div>

                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Due Date</span>
                    <p class="text-gray-900 dark:text-gray-100">
                        {{ $assignment->due_at ? \Carbon\Carbon::parse($assignment->due_at)->format('d M Y') : 'No due date set.' }}
                    </p>
                </div>

                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</span>
                    <p class="text-gray-900 dark:text-gray-100">{{ $assignment->description ?? 'No description provided.' }}</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('assignments.edit', $assignment) }}"
                        class="px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                        Edit
                    </a>
                    <a href="{{ route('assignments.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
