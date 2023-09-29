<?php

namespace App\Console\Commands;

use App\Repository\StudentiRepository;
use Illuminate\Console\Command;

class readStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-student';

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
        $matricola = $this->ask("Quale e la matricola dello studente che state cercando");
        $student = $repository->getStudent($matricola);

        $this->line("Id: $student->matricola");
        $this->line("Nome: $student->nome");
        $this->line("Cognome: $student->cognome");
        $this->line("Voti: Math " . $student->voti[0] . ", scienza " . $student->voti[1] . ", informatica " . $student->voti[2]);
    }
}
