<?php

namespace App\Console\Commands;

use App\Factory\ScuolaFactory;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class updateSchool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:update';

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
            $continue = 'n';
            $schoolCode = $this->ask("Inserisca il codice della scuola a modificare");
            $salari = [];
            try {
                $scuola = $repository->getScuola($schoolCode);
                $nome = $this->ask("Come si chiama la scuola");
                do {
                    $salario = $this->ask("Inserisca uno dei salari della scuola");
                    if ($salario != null) {
                        $salari[] = $salario;
                    }
                    $addSalary = $this->ask("vuoi aggiungere altri salari");
                } while ($addSalary === 'y' || $addSalary === 'si' || $addSalary === 'yes' || $addSalary === 's');

                $scuola->nome = $nome ?? $scuola->nome;
                $scuola->salari = count($salari) > 0 ? $salari : $scuola->salari;
                $repository->updateScuola($scuola);
            } catch (\Exception $e) {
                $continue = $this->ask("Scuola non trovata cercare di nuovo: y/n");
            }
        } while ($continue === 'y' || $continue === 'si' || $continue === 'yes' || $continue === 's');
    }
}
