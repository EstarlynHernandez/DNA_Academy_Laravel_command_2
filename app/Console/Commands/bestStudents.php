<?php

namespace App\Console\Commands;

use App\Management\scuolaManagement;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class bestStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:best_students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(scuolaManagement $management, ScuolaRepository $repository)
    {
        $bestStudents = [];
        foreach ($repository->getAll() as $scuola) {
            foreach ($management->studenti($scuola->codice) as $student) {
                if (array_sum($student->voti) > array_sum($bestStudent->voti ?? [0, 0])) {
                    $bestStudent = $student;
                }
            }
            if (isset($bestStudent)) {
                $bestStudent->scuola = $scuola->nome;
                $bestStudents[] = $bestStudent;
            }
        }
        foreach ($bestStudents as $studente) {
            $this->line("--------------------------------------------");
            $this->line("Scuola: $studente->scuola");
            $this->line("Matricola: $studente->matricola | Nome: $studente->nome | Cognome: $studente->cognome");
            $this->line("Math: " . $studente->voti[0] . " | Scienza: " . $studente->voti[1] . " | Informatica: " . $studente->voti[2]);
        }
        $this->line("--------------------------------------------");
    }
}
