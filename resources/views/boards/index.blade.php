<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Board') }}  {{--Dashboard--}}
            </h2>
            <!-- Кнопка для создания доски -->
            <a href="{{ route('boards.create') }}" class="btn btn-primary">
                Создать доску
            </a>
        </div>
    </x-slot>
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($boards as $board)
                <a href="/boards/{{$board['id']}}" class="group block p-4 border border-gray-300 rounded-lg bg-gray-50 shadow-sm">
                    <div class="w-full h-64 bg-gray-300 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">{{ $board->title }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
