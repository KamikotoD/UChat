<x-app-layout>
    <form method="POST" action="{{ route('boards.store') }}" class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        @csrf
        <x-slot name="header">
            <h2 class="text-3xl font-semibold text-center text-gray-800">Create Board</h2>
        </x-slot>

        <!-- Title -->
        <div class="mt-6">
            <x-input-label for="title" :value="__('Board Title')" />
            <div class="max-w-md mx-auto">
                <x-text-input id="title" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
            </div>
            <x-input-error :messages="$errors->get('title')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Board Description')" />
            <div class="max-w-md mx-auto">
                <x-text-input id="description" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="description" :value="old('description')" />
            </div>
            <x-input-error :messages="$errors->get('description')" class="mt-2 text-sm text-red-600" />
        </div>


        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('dashboard') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ __('Create Board') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
