<?php

namespace App\Console\Commands;

use App\Repository\StudentiRepository;
use Illuminate\Console\Command;

class getStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-students';

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
        foreach ($repository->getStudents() as $student) {
            $this->line("--------------------------------------------");
            $this->line("Matricola: $student->matricola | Nome: $student->nome | Cognome: $student->cognome");
            $this->line("Math: " . $student->voti[0] . " | Scienza: ". $student->voti[1] . " | Informatica: ". $student->voti[2]);
        }
        $this->line("--------------------------------------------");
    }
}
