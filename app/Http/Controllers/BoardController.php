<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadCreate;
use App\Models\Board;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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
        $board = Board::with(['threads' => function ($query) {
                $query->whereNull('parent_id');
            }])
            ->where('url', '=', $board)
            ->first();
        
        if (! $board) {
            return redirect(route('index'));
        }

        return Inertia::render('Board', [
            'board' => $board,
        ]);
    }

    /**
     * Make a new thread.
     * @param string $board
     * @return RedirectResponse
     */
    public function thread(ThreadCreate $request, string $board): RedirectResponse
    {
        $board = Board::where('url', '=', $board)->first();
        if (! $board) {
            return redirect(route('index'));
        }

        $lastId = 0;
        $lastPost = DB::table('posts')->where('board_id', '=', $board->id)->latest('post_id')->first();
        if ($lastPost) {
            $lastId = $lastPost->post_id;
        }

        $post = Post::create(array_merge([
            'board_id' => $board->id,
            'post_id' => $lastId + 1,
            'parent_id' => null,
            'is_deleted' => false,
        ], $request->validated()));

        return redirect(route('thread', [
            'board' => $board->url,
            'thread' => $post->post_id,
        ]));
    }
}
