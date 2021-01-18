<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BoardController extends Controller
{
    /**
     * Render the board index.
     * @param string $board
     * @return Response|RedirectResponse
     */
    public function index(string $board): Response|RedirectResponse
    {
        $board = Board::where('url', '=', $board)->first();
        if (! $board) {
            return redirect(route('index'));
        }

        return Inertia::render('Board', [
            'board' => $board,
        ]);
    }
}
