<?php

namespace App\Console\Commands;

use App\Factory\StudentiFactory;
use App\Repository\ScuolaRepository;
use App\Repository\StudentiRepository;
use Illuminate\Console\Command;

class saveStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(StudentiFactory $studentiFactory, StudentiRepository $studentiRepository, ScuolaRepository $repository): void
    {
        do {
            $schools = $repository->getAll();
            $findSchool = false;
            $this->info("Le scuole disponibili sono");
            foreach ($schools as $key => $school) {
                $this->line($key + 1 . ") " . $school->nome . " | Codice scuola: " . $school->codice);
            }

            $schoolCode = $this->ask("Inserisca il codice della scuola o la posizione della scuola");

            foreach ($schools as $key => $school) {
                if ($key + 1 == $schoolCode || $school->codice == $schoolCode) {
                    $findSchool = $school->codice;
                }
            }

            if ($findSchool) {
                $nome = $this->ask("Inserisca il nome dello studente");
                $cognome = $this->ask("Inserisca il cognome dello studente");
                $math = $this->ask("Inserisca il voto dello studente in matematica");
                $scie = $this->ask("Inserisca il voto dello studente in scienza");
                $info = $this->ask("Inserisca il voto dello studente in informatica");

                $student = $studentiFactory::create(['nome' => $nome,
                    'cognome' => $cognome,
                    'voti' => [$math, $scie, $info],
                    'codice_scuola' => $findSchool
                ]);

                $studentiRepository->saveStudent($student);
            } else {
                $this->warn('Scuola no trovata');
            }

            $condition = $this->ask("Vuoi aggiungere un altro studente 'y/n'");
        } while ($condition === 'y' || $condition === 'si' || $condition === 'yes');

        $this->line("studenti aggiunti con esito");
    }
}
