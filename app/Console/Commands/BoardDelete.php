<?php

namespace App\Console\Commands;

use App\Models\Board;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Repository as Cache;

class BoardDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:delete {board}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an existing board.';

    protected Cache $cache;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Cache $cache)
    {
        parent::__construct();

        $this->cache = $cache;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arg = $this->argument('board');
        $board = Board::where('url', '=', $arg)->first();
        if (! $board) {
            $this->error("Board \"{$arg}\" does not exist.");
            return 0;
        }

        if (! $this->confirm("Are you sure you want to delete the \"{$board->name}\" board?")) {
            $this->error("Canceling board deletion.");
            return 0;
        }

        $board->delete();
        $this->info("Board successfully deleted.");

        $this->cache->forget('boards');
        $this->info('Cleared board cache.');

        return 0;
    }
}
