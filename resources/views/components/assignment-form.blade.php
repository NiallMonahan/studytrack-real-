@props([
    'action',
    'method' => 'POST',
    'assignment' => null,
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
                    {{ old('module_id', $assignment->module_id ?? '') == $module->id ? 'selected' : '' }}>
                    {{ $module->code }} — {{ $module->title }}
                </option>
            @endforeach
        </select>
        @error('module_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Title --}}
    <div>
        <label for="title" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Title</label>
        <input id="title" type="text" name="title"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            placeholder="Assignment title"
            value="{{ old('title', $assignment->title ?? '') }}" required>
        @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Due Date --}}
    <div>
        <label for="due_at" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Due Date</label>
        <input id="due_at" type="date" name="due_at"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            value="{{ old('due_at', $assignment?->due_at ? \Carbon\Carbon::parse($assignment->due_at)->format('Y-m-d') : '') }}">
        @error('due_at') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Description</label>
        <textarea id="description" name="description" rows="4"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            placeholder="Details about the assignment">{{ old('description', $assignment->description ?? '') }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Weight & Grade (side by side) --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="weight" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                Worth (% of module grade)
            </label>
            <input id="weight" type="number" name="weight" min="1" max="100"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
                placeholder="e.g. 20"
                value="{{ old('weight', $assignment->weight ?? '') }}">
            @error('weight') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="grade" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                Grade Received (%)
            </label>
            <input id="grade" type="number" name="grade" min="0" max="100"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
                placeholder="e.g. 85"
                value="{{ old('grade', $assignment->grade ?? '') }}">
            @error('grade') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <button type="submit"
            class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-500">
            {{ $assignment ? 'Update Assignment' : 'Create Assignment' }}
        </button>
        <a href="{{ route('assignments.index') }}"
            class="text-sm text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-700 dark:hover:text-gray-200">
            Cancel
        </a>
    </div>
</form>
