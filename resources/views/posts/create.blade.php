<x-app-layout>
    <form method="POST" action="{{ route('posts.store', $board) }}" class="max-w-lg mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        @csrf
        <x-slot name="header">
            <h2 class="text-3xl font-semibold text-center text-gray-800">Create Post</h2>
        </x-slot>

        <!-- Title -->
        <div class="mt-6">
            <x-input-label for="title" :value="__('Post Title')" />
            <div class="max-w-md mx-auto">
                <x-text-input id="title" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
            </div>
            <x-input-error :messages="$errors->get('title')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- content -->
        <div class="mt-4">
            <x-input-label for="content" :value="__('Post Content')" />
            <div class="max-w-md mx-auto">
                <x-text-input id="content" class="block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="content" :value="old('content')" />
            </div>
            <x-input-error :messages="$errors->get('content')" class="mt-2 text-sm text-red-600" />
        </div>


        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('boards.show', ['board' => $board->id]) }}">
                {{ __('Cancel') }}
            </a>

            <x-primary-button class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                {{ __('Create Post') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
