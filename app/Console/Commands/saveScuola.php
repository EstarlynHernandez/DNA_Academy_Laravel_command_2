<?php

namespace App\Console\Commands;

use App\Factory\ScuolaFactory;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class saveScuola extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScuolaFactory $factory, ScuolaRepository $repository)
    {
        do {
            $salari = [];
            $nome = $this->ask("Come si chiama la scuola");
            do {
                $salario = $this->ask("Inserisca uno dei salari della scuola");
                if ($salario != null) {
                    $salari[] = $salario;
                }
                $addSalary = $this->ask("vuoi aggiungere altri salari");
            } while ($addSalary === 'y' || $addSalary === 'si' || $addSalary === 'yes' || $addSalary === 's');

            $scuola = $factory::create($nome, null, $salari);
            $repository->addScuola($scuola);
            $continue = $this->ask("Aggiungere un altra scuola: y/n");
        } while($continue === 'y' || $continue === 'si' || $continue === 'yes' || $continue === 's');
    }
}
