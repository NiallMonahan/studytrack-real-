<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Assignments
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('assignments.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Assignment
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left text-gray-900 dark:text-gray-100">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4">Title</th>
                            <th class="p-4">Module</th>
                            <th class="p-4">Due Date</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr class="border-t border-gray-200 dark:border-gray-600">
                                <td class="p-4">{{ $assignment->title }}</td>
                                <td class="p-4">{{ $assignment->module->code }} — {{ $assignment->module->title }}</td>
                                <td class="p-4">{{ $assignment->due_at ? \Carbon\Carbon::parse($assignment->due_at)->format('d M Y') : '—' }}</td>
                                <td class="p-4 flex gap-2">
                                    <a href="{{ route('assignments.show', $assignment) }}"
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        View
                                    </a>
                                    <a href="{{ route('assignments.edit', $assignment) }}"
                                        class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('assignments.destroy', $assignment) }}" method="POST"
                                        onsubmit="return confirm('Delete this assignment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">No assignments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
