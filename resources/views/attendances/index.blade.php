<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Attendance
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
                <a href="{{ route('attendances.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Record Attendance
                </a>
            </div>

            {{-- Per-module attendance rates --}}
            @php
                $grouped = $attendances->groupBy('module_id');
            @endphp

            @if($grouped->isNotEmpty())
                <div class="flex flex-wrap gap-4">
                    @foreach($grouped as $moduleId => $records)
                        @php
                            $module = $records->first()->module;
                            $total = $records->count();
                            $present = $records->whereIn('status', ['present', 'late'])->count();
                            $rate = round(($present / $total) * 100);
                        @endphp
                        <div class="flex-1 min-w-[180px] bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700">
                            <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $module->code }} — {{ $module->title }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $present }}/{{ $total }} classes attended</p>
                            <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $rate >= 80 ? 'bg-green-500' : ($rate >= 60 ? 'bg-yellow-400' : 'bg-red-500') }}"
                                    style="width: {{ $rate }}%"></div>
                            </div>
                            <p class="text-sm font-medium mt-1 {{ $rate >= 80 ? 'text-green-600' : ($rate >= 60 ? 'text-yellow-500' : 'text-red-600') }}">
                                {{ $rate }}%
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Attendance records table --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-left text-gray-900 dark:text-gray-100">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4">Module</th>
                            <th class="p-4">Date</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr class="border-t border-gray-200 dark:border-gray-600">
                                <td class="p-4">{{ $attendance->module->code }} — {{ $attendance->module->title }}</td>
                                <td class="p-4">{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded text-sm font-medium
                                        {{ $attendance->status === 'present' ? 'bg-green-100 text-green-700' : ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td class="p-4 flex gap-2">
                                    <a href="{{ route('attendances.edit', $attendance) }}"
                                        class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('attendances.destroy', $attendance) }}" method="POST"
                                        onsubmit="return confirm('Delete this record?')">
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
                                <td colspan="4" class="p-4 text-center text-gray-500">
                                    No attendance records yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
