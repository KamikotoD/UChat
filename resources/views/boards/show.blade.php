<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800">{{ $board->title }}</h1>
        <p class="text-gray-600 mt-2">{{ $board->description }}</p>
        <p class="text-sm text-gray-500 mt-4">Создано: {{ $board->created_at->format('d.m.Y H:i') }}</p>
        <p class="text-sm text-gray-500">Автор: {{ $board->user->name }}</p>

        <div class="mt-6">
            <a href="{{ route('boards.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
            @if(auth()->id() === $board->user_id)
                <a href="/boards/{{ $board->id }}/edit" type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Edit</a>
            @endif
            @if(auth()->id() === $board->user_id)
                <form action="{{ route('boards.destroy', $board) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
