<?php

namespace App\Console\Commands;

use App\Models\Board;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Repository as Cache;

class BoardCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new board.';

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
        $board = Board::create([
            'name' => $this->ask('Board name?'),
            'url' => $this->ask('Board URL?'),
            'tagline' => $this->ask('Board tagline?'),
        ]);

        $this->info("New board successfully created: {$board->name}");

        $this->cache->forget('boards');
        $this->info('Cleared board cache.');

        return 0;
    }
}
