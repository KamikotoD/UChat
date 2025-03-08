<?php

namespace App\Http\Controllers;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BoardController extends Controller
{
    public function __construct()
    {
        $this-> middleware('auth');  // Авторизация для всех методов
    }

    public function index()
    {
        $boards = Board::all();
        return view('boards.index', compact('boards'));
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Board::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),  // Сохраняем id текущего авторизованного пользователя
        ]);

        return redirect()->route('boards.index');
    }

    public function destroy(Board $board)
    {
        // Проверка на право удаления
        if ($board->user_id != auth()->id()) {
            return redirect()->route('boards.index')->withErrors('Вы не можете удалить эту доску');
        }

        $board->delete();
        return redirect()->route('boards.index');
    }
}
