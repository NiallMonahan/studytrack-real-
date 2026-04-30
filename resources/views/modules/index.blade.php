<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modules
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
                <a href="{{ route('modules.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Module
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left text-gray-900 dark:text-gray-100">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4">Code</th>
                            <th class="p-4">Title</th>
                            <th class="p-4">Description</th>
                            <th class="p-4">Module Grade</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($modules as $module)
                            <tr class="border-t border-gray-200 dark:border-gray-600">
                                <td class="p-4">{{ $module->code }}</td>
                                <td class="p-4">{{ $module->title }}</td>
                                <td class="p-4">{{ $module->description ?? '—' }}</td>
                                <td class="p-4">
                                    @php
                                        $graded = $module->assignments->filter(fn($a) => $a->grade !== null && $a->weight !== null);
                                        $moduleGrade = $graded->sum(fn($a) => $a->grade * $a->weight / 100);
                                        $totalWeight = $graded->sum('weight');
                                    @endphp
                                    @if($graded->count())
                                        <span class="font-semibold {{ $moduleGrade >= 70 ? 'text-green-600' : ($moduleGrade >= 50 ? 'text-yellow-500' : 'text-red-600') }}">
                                            {{ round($moduleGrade, 1) }}/{{ $totalWeight }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="p-4 flex gap-2">
                                    <a href="{{ route('modules.show', $module) }}"
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        View
                                    </a>
                                    <a href="{{ route('modules.edit', $module) }}"
                                        class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('modules.destroy', $module) }}" method="POST"
                                        onsubmit="return confirm('Delete this module?')">
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
                                <td colspan="5" class="p-4 text-center text-gray-500">No modules yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>