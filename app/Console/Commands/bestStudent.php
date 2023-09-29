<?php

namespace App\Console\Commands;

use App\Management\scuolaManagement;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class bestStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:best_student';

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
        do {
            $schools = $repository->getAll();
            $this->info("Le scuole disponibili sono");
            foreach ($schools as $key => $school) {
                $this->line($key + 1 . ") " . $school->nome . " | Codice scuola: " . $school->codice);
            }

            $schoolCode = $this->ask("Inserisca il codice della scuola o la posizione della scuola");

            foreach ($schools as $key => $school) {
                if ($key + 1 == $schoolCode || $school->codice == $schoolCode) {
                    $findSchool = $school;
                }
            }

            $condition = false;

            if (isset($findSchool)) {

                foreach ($management->studenti($findSchool->codice) as $student) {
                    if (array_sum($student->voti) > array_sum($bestStudent->voti ?? [0, 0])) {
                        $bestStudent = $student;
                    }
                }

                if (isset($bestStudent)) {
                    $this->line("--------------------------------------------");
                    $this->line("Scuola: $findSchool->nome");
                    $this->line("Matricola: $bestStudent->matricola | Nome: $bestStudent->nome | Cognome: $bestStudent->cognome");
                    $this->line("Math: " . $bestStudent->voti[0] . " | Scienza: " . $bestStudent->voti[1] . " | Informatica: " . $bestStudent->voti[2]);
                    $this->line("--------------------------------------------");
                } else {
                    $this->warn("non ci sono studenti in questa scuola");
                    $condition = $this->ask("Vuoi cercare in un altra scuola y/n");
                }
            } else {
                $this->warn("Scuola no trovata");
                $condition = $this->ask("Vuoi cercare in un altra scuola y/n");
            }
        } while ($condition === 'y' || $condition === 'si' || $condition === 'yes');
    }
}
