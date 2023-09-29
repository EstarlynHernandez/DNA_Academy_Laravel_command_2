<?php

namespace App\Console\Commands;

use App\Factory\StudentiFactory;
use App\Repository\StudentiRepository;
use Illuminate\Console\Command;

class updateStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(StudentiRepository $repository, StudentiFactory $factory): void
    {
        do {
            $condition = 'n';
            $matricola = $this->ask("Inserisca la matricola dello studente a modificare");
            try {
                $studente = $repository->getStudent($matricola);
            } catch (\Exception $err) {
                $this->warn("Studente non trovato");
                $condition = $this->ask("Vuoi inserirne un'altro 'y/n'");
            }
        } while ($condition === 'y' || $condition === 'si' || $condition === 'yes');
        if ($condition == 'n' && isset($studente)) {
            $nome = $this->ask("Inserisca il nome dello studente");
            $cognome = $this->ask("Inserisca il cognome dello studente");
            $math = $this->ask("Inserisca il voto dello studente in matematica");
            $scie = $this->ask("Inserisca il voto dello studente in scienza");
            $info = $this->ask("Inserisca il voto dello studente in informatica");

            $studente->nome = $nome ?? $studente->nome;
            $studente->cognome = $cognome ?? $studente->cognome;
            $studente->voti = [$math ?? $studente->voti[0],
                $scie ?? $studente->voti[1],
                $info ?? $studente->voti[2]
            ];

            $repository->aggiornaStudente($studente);
        }
    }
}
