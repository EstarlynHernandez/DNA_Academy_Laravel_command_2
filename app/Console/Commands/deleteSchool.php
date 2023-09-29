<?php

namespace App\Console\Commands;

use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class deleteSchool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScuolaRepository $repository)
    {
        do {
            $research = 'n';
            $school = $this->ask("Qual'e il codice della scuola a eliminare");
            if ($repository->deleteScuola($school)) {
                $this->line('Scuola Eliminata');
            } else {
                $this->warn('Scuola non trovata');
                $research = $this->ask('Vuoi Riprovare ad inserire il codice scuola y/n');
            }
        } while ($research === 'y' || $research === 'yes' || $research === 'si' || $research === 's');
    }
}
