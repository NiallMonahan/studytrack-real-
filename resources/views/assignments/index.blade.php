<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Assignments
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <a href="{{ route('assignments.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Assignment
                </a>
            </div>

            {{-- Pending Assignments --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pending</h3>
                </div>
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
                        @forelse($pending as $assignment)
                            <tr class="border-t border-gray-200 dark:border-gray-600">
                                <td class="p-4">{{ $assignment->title }}</td>
                                <td class="p-4">{{ $assignment->module->code }} — {{ $assignment->module->title }}</td>
                                <td class="p-4">
                                    @if($assignment->due_at)
                                        <span class="{{ \Carbon\Carbon::parse($assignment->due_at)->isPast() ? 'text-red-500 font-medium' : '' }}">
                                            {{ \Carbon\Carbon::parse($assignment->due_at)->format('d M Y') }}
                                        </span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="p-4 flex gap-2 items-center">
                                    <form action="{{ route('assignments.toggle', $assignment) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600" title="Mark complete">
                                            ✓
                                        </button>
                                    </form>
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
                                <td colspan="4" class="p-4 text-center text-gray-500">No pending assignments.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Completed Assignments --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Completed</h3>
                </div>
                <table class="w-full text-left text-gray-900 dark:text-gray-100">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4">Title</th>
                            <th class="p-4">Module</th>
                            <th class="p-4">Due Date</th>
                            <th class="p-4">Grade</th>
                            <th class="p-4">Worth</th>
                            <th class="p-4">Contribution</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($completed as $assignment)
                            <tr class="border-t border-gray-200 dark:border-gray-600 opacity-60">
                                <td class="p-4 line-through">{{ $assignment->title }}</td>
                                <td class="p-4">{{ $assignment->module->code }} — {{ $assignment->module->title }}</td>
                                <td class="p-4">{{ $assignment->due_at ? \Carbon\Carbon::parse($assignment->due_at)->format('d M Y') : '—' }}</td>
                                <td class="p-4">
                                    @if($assignment->grade !== null)
                                        <span class="px-2 py-1 rounded text-sm font-medium
                                            {{ $assignment->grade >= 70 ? 'bg-green-100 text-green-700' : ($assignment->grade >= 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                            {{ $assignment->grade }}%
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    {{ $assignment->weight !== null ? $assignment->weight . '%' : '—' }}
                                </td>
                                <td class="p-4 font-medium">
                                    @if($assignment->grade !== null && $assignment->weight !== null)
                                        {{ round($assignment->grade * $assignment->weight / 100, 1) }} / {{ $assignment->weight }}
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="p-4 flex gap-2 items-center">
                                    <form action="{{ route('assignments.toggle', $assignment) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500" title="Mark incomplete">
                                            ↩
                                        </button>
                                    </form>
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
                                <td colspan="7" class="p-4 text-center text-gray-500">No completed assignments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
