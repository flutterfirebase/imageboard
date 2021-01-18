<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyCreate;
use App\Models\Board;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ThreadController extends Controller
{
    /**
     * Render the thread.
     * @param string $board
     * @param string $post
     * @return Response|RedirectResponse
     */
    public function index(string $board, string $post): Response|RedirectResponse
    {
        $board = Board::where('url', '=', $board)->first();
        if (! $board) {
            redirect(route('index'));
        }

        $thread = Post::with(['replies'])
            ->where('board_id', '=', $board->id)
            ->where('post_id', '=', $post)
            ->where('parent_id', '=', null)
            ->first();

        if (! $thread) {
            return redirect(route('board', [
                'board' => $board->url,
            ]));
        }

        return Inertia::render('Thread', [
            'board' => $board,
            'thread' => $thread,
        ]);
    }

    /**
     * Make a new reply.
     * @param string $board
     * @param string $thread
     * @return Post
     */
    public function reply(ReplyCreate $request, string $board, string $thread): Post
    {
        $board = Board::where('url', '=', $board)->first();
        if (! $board) {
            redirect(route('index'));
        }

        $lastPost = DB::table('posts')->where('board_id', '=', $board->id)->latest('post_id')->first();

        $post = Post::create(array_merge([
            'post_id' => $lastPost->post_id + 1,
            'parent_id' => $thread,
            'board_id' => $board->id,
            'is_deleted' => false,
        ], $request->validated()));

        return $post;
    }
}
