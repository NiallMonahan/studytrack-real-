@props([
    'action',
    'method' => 'POST',
    'module' => null,
])

<form action="{{ $action }}" method="POST"
    class="space-y-5 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 shadow-sm">
    @csrf
    @if(in_array($method, ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    {{-- Code --}}
    <div>
        <label for="code" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Module Code</label>
        <input id="code" type="text" name="code"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            placeholder="e.g. WEB301"
            value="{{ old('code', $module->code ?? '') }}" required>
        @error('code') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Title --}}
    <div>
        <label for="title" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Title</label>
        <input id="title" type="text" name="title"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            placeholder="Module title"
            value="{{ old('title', $module->title ?? '') }}" required>
        @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Description</label>
        <textarea id="description" name="description" rows="4"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 p-2.5 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/40 transition"
            placeholder="What is this module about?">{{ old('description', $module->description ?? '') }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <button type="submit"
            class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-500">
            {{ $module ? 'Update Module' : 'Create Module' }}
        </button>
        <a href="{{ route('modules.index') }}"
            class="text-sm text-gray-500 dark:text-gray-400 underline underline-offset-4 hover:text-gray-700 dark:hover:text-gray-200">
            Cancel
        </a>
    </div>
</form>
