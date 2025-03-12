<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Post;
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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
