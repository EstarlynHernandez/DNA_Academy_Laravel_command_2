<?php

namespace App\Console\Commands;

use App\Repository\StudentiRepository;
use Illuminate\Console\Command;

class deleteStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(StudentiRepository $repository): void
    {
        do {
            $condition = 'n';
            $matricola = $this->ask("Inserisca la matricola dello studente a eliminare dal registro");
            try {
                $repository->getStudent($matricola);
                $repository->deleteStudente($matricola);
                $this->warn("Studente eliminato");
            } catch (\Exception $err) {
                $this->warn("Studente non trovato");
                $condition = $this->ask("Vuoi inserirne un'altro 'y/n'");
            }
        } while ($condition === 'y' || $condition === 'si' || $condition === 'yes' || $condition === 's');
    }
}
