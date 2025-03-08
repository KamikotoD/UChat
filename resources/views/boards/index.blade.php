<x-app-layout>
    <div class="container mx-auto px-4 py-16">
        <x-slot name="header">
            <h2 class="text-3xl font-semibold text-center text-gray-800">Board</h2>
        </x-slot>

        <h2 class="text-2xl font-bold text-gray-900 mb-6">Boards</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($boards as $board)
                <a href="#" class="group block p-4 border border-gray-300 rounded-lg bg-gray-50 shadow-sm">
                    <div class="w-full h-64 bg-gray-300 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">{{ $board->title }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
