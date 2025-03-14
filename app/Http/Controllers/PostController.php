<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create(Board $board)
    {

        return view('posts.create', compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Board $board)
    {
        request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'user_id' => auth()->id(),
            'board_id' => $board->id
        ]);

        return redirect()->route('boards.show', ['board' => $board->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board, Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post)
    {
        request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        $post->update([
            'title' => request('title'),
            'content' => request('content')
        ]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != auth()->id()) {
            return redirect()->route('boards.show', ['board' => $post->board_id])
                ->withErrors('Вы не можете удалить этот пост');
        }

        $post->delete();

        return redirect()->route('boards.show', ['board' => $post->board_id]);
    }
    // Метод для лайка
    public function like(Post $post)
    {
        $userId = auth()->id();

        // Проверка, поставил ли пользователь уже лайк
        $existingLike = PostLike::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->where('type', 'like')
            ->first();
        $existingDislike = PostLike::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->where('type', 'dislike')
            ->first();

        if ($existingDislike) {
            // Убираем дизлайк, если он был
            $existingDislike->delete();
            $post->decrement('dislikes');
        }

        if ($existingLike) {
            // Если лайк уже есть, отменяем его
            $existingLike->delete();
            $post->decrement('likes');
        } else {
            // В противном случае добавляем лайк
            PostLike::create([
                'user_id' => $userId,
                'post_id' => $post->id,
                'type' => 'like',
            ]);
            $post->increment('likes');
        }

        return back();
    }

    public function dislike(Post $post)
    {
        $userId = auth()->id();

        // Проверка, поставил ли пользователь уже дизлайк
        $existingDislike = PostLike::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->where('type', 'dislike')
            ->first();
        $existingLike = PostLike::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->where('type', 'like')
            ->first();

        if ($existingLike) {
            // Убираем лайк, если он был
            $existingLike->delete();
            $post->decrement('likes');
        }

        if ($existingDislike) {
            // Если дизлайк уже есть, отменяем его
            $existingDislike->delete();
            $post->decrement('dislikes');
        } else {
            // В противном случае добавляем дизлайк
            PostLike::create([
                'user_id' => $userId,
                'post_id' => $post->id,
                'type' => 'dislike',
            ]);
            $post->increment('dislikes');
        }

        return back();
    }




}
