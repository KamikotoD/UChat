<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">

        <!-- Заголовок та інформація про пост -->
        <div class="bg-white shadow-md p-6 rounded-lg">
            <h1 class="text-3xl font-bold text-gray-800">{{ $post->title }}</h1>
            <p class="mt-4 text-lg text-gray-600">{{ $post->content }}</p>
            <div class="mt-4 flex items-center space-x-4">
                <p class="text-sm text-gray-500">Автор: {{ $post->user->name }}</p>
                <p class="text-sm text-gray-500">Создано: {{ $post->created_at->format('d.m.Y H:i') }}</p>
            </div>

            <!-- Кнопки для управління постом -->
            <div class="mt-6 flex justify-between items-center">
                <div class="flex space-x-2">
                    <a href="{{ route('boards.show', $post->board) }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Back to Board
                    </a>
                    @if(auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Секція з коментарями (якщо потрібно) -->
        <div class="bg-white shadow-md p-6 rounded-lg mt-6">

        </div>
    </div>
</x-app-layout>
