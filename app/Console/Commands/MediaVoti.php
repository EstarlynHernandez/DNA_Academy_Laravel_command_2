<?php

namespace App\Console\Commands;

use App\Management\studentManagement;
use Illuminate\Console\Command;

class MediaVoti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:media-voti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(studentManagement $management)
    {
        $this->line("La media di tutti gli studenti e di " . $management->mediaVoti());
    }
}
