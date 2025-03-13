<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">

        <div class="bg-gray-700 text-white p-4 rounded-lg">
            <h1 class="text-2xl font-bold">{{ $board->title }}</h1>
            <p class="mt-2">{{ $board->description }}</p>
            <p class="text-sm mt-4">Создано: {{ $board->created_at->format('d.m.Y H:i') }}</p>
            <p class="text-sm">Автор: {{ $board->user->name }}</p>
            <!-- Кнопки управления -->
            <div class="flex justify-between items-center">
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
                <!-- Кнопка для создания post -->
                <a href="{{ route('posts.create', $board) }}" class="px-4 py-2 bg-white-500 text-white rounded-md hover:bg-gray-600">
                    Create Post
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md p-4 rounded-lg">
            @forelse ($posts as $post)
                <div class="border-b border-gray-300 py-4">
                    <a href="{{ route('posts.show', ['board' => $post->board_id, 'post' => $post->id]) }}">
                        <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                        <!--<p class="text-gray-600">{{ $post->content }}</p>-->
                        <p class="text-sm text-gray-500">Автор: {{ $post->user->name }}</p>
                    </a>
                    <!-- Лайки і дизлайки -->
                    <div class="mt-2 flex space-x-4 items-center">
                        <!-- Лайки -->
                        <form action="{{ route('posts.like', $post) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 text-sm text-blue-500 hover:text-blue-600">
                                <span>👍</span>
                                <span>{{  $post->totalLikes()}}</span>
                            </button>
                        </form>

                        <!-- Дизлайки -->
                        <form action="{{ route('posts.dislike', $post) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 text-sm text-red-500 hover:text-red-600">
                                <span>👎</span>
                                <span>{{ $post->totalDislikes() }}</span>
                            </button>
                        </form>
                </div>
            @empty
                <p class="text-gray-500">Постов пока нет.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
