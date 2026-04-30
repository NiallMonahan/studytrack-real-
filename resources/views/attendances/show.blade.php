<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Attendance Record
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-4">

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Module</p>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ $attendance->module->code }} — {{ $attendance->module->title }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Date</p>
                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                    <span class="px-2 py-1 rounded text-sm font-medium
                        {{ $attendance->status === 'present' ? 'bg-green-100 text-green-700' : ($attendance->status === 'late' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($attendance->status) }}
                    </span>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('attendances.edit', $attendance) }}"
                        class="px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                        Edit
                    </a>
                    <a href="{{ route('attendances.index') }}"
                        class="text-sm text-gray-500 underline underline-offset-4 hover:text-gray-700 self-center">
                        Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
