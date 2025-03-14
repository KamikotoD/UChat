<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post) {

        $request->validate([
            'content' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => request('content')
        ]);

        return redirect()->route('posts.show', ['board' => $post->board_id, 'post' => $post->id])->with('success', 'Комментарий добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the content of the comment
        $request->validate([
            'content' => 'required|string',
        ]);

        // Find the comment by id
        $comment = Comment::findOrFail($id);

        // Check if the authenticated user is the author of the comment
        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Вы не можете редактировать этот комментарий!');
        }

        // Update the comment content
        $comment->content = $request->input('content');
        $comment->save();

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', ['board' => $comment->post->board_id, 'post' => $comment->post->id])
            ->with('success', 'Комментарий обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if the authenticated user is the author of the comment
        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Вы не можете удалить этот комментарий!');
        }

        // Delete the comment
        $comment->delete();

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', ['board' => $comment->post->board_id, 'post' => $comment->post->id])
            ->with('success', 'Комментарий удален!');
    }
}
