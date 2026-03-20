<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Assignment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-assignment-form :action="route('assignments.update', $assignment)" method="PUT" :assignment="$assignment" :modules="$modules" />
        </div>
    </div>
</x-app-layout>
