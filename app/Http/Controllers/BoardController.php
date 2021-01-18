<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Inertia\Inertia;
use Inertia\Response;

class BoardController extends Controller
{
    /**
     * Render the board index.
     * @param string $board
     * @return Response
     */
    public function index(string $board): Response
    {
        $board = Board::where('url', '=', $board)->first();
        if (! $board) {
            return redirect('index');
        }

        return Inertia::render('Board', [
            'board' => $board,
        ]);
    }
}
