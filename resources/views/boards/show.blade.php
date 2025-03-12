<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">
        <!-- Верхний блок с информацией -->
        <div class="bg-gray-700 text-white p-4 rounded-lg">
            <h1 class="text-2xl font-bold">{{ $board->title }}</h1>
            <p class="mt-2">{{ $board->description }}</p>
            <p class="text-sm mt-4">Создано: {{ $board->created_at->format('d.m.Y H:i') }}</p>
            <p class="text-sm">Автор: {{ $board->user->name }}</p>
            <!-- Кнопки управления -->
            <div class="flex space-x-2">
                <a href="{{ route('boards.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
                @if(auth()->id() === $board->user_id)
                    <a href="/boards/{{ $board->id }}/edit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Edit</a>
                    <form action="{{ route('boards.destroy', $board) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Нижний блок с постами -->
        <div class="bg-white shadow-md p-4 rounded-lg">

        </div>


    </div>
</x-app-layout>
