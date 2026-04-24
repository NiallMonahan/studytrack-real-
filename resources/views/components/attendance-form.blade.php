    @props([
    'action',
    'method' => 'POST',
    'attendance' => null,
    'modules',
])

<form action="{{ $action }}" method="POST"
    class="space-y-5 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 shadow-sm">
    @csrf
    @if(in_array($method, ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    {{-- Module --}}
    <div>
        <label for="module_id" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Module</label>
        <select id="module_id" name="module_id"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            required>
            <option value="">Select a module</option>
            @foreach($modules as $module)
                <option value="{{ $module->id }}"
                    {{ old('module_id', $attendance->module_id ?? '') == $module->id ? 'selected' : '' }}>
                    {{ $module->code }} — {{ $module->title }}
                </option>
            @endforeach
        </select>
        @error('module_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Student Name --}}
    <div>
        <label for="student_name" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Student Name</label>
        <input id="student_name" type="text" name="student_name"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            placeholder="Student name"
            value="{{ old('student_name', $attendance->student_name ?? '') }}" required>
        @error('student_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Date --}}
    <div>
        <label for="date" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Date</label>
        <input id="date" type="date" name="date"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            value="{{ old('date', $attendance?->date ? \Carbon\Carbon::parse($attendance->date)->format('Y-m-d') : '') }}"
            required>
        @error('date') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Status --}}
    <div>
        <label for="status" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Status</label>
        <select id="status" name="status"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            required>
            <option value="">Select status</option>
            <option value="present" {{ old('status', $attendance->status ?? '') == 'present' ? 'selected' : '' }}>Present</option>
            <option value="absent" {{ old('status', $attendance->status ?? '') == 'absent' ? 'selected' : '' }}>Absent</option>
            <option value="late" {{ old('status', $attendance->status ?? '') == 'late' ? 'selected' : '' }}>Late</option>
        </select>
        @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <button type="submit"
            class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-500">
            {{ $attendance ? 'Update Attendance' : 'Create Attendance' }}
        </button>
        <a href="{{ route('attendances.index') }}"
            class="text-sm text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-700 dark:hover:text-gray-200">
            Cancel
        </a>
    </div>
</form>