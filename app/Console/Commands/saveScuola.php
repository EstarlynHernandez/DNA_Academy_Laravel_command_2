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
    protected $signature = 'app:save-scuola';

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
            $nome = $this->ask("Come si chiama la scuola");
            do {
                $salari[] = $this->ask("Inserisca uno dei salari della scuola");
                $addSalary = $this->ask("vuoi aggiungere altri salari");
            } while ($addSalary === 'y' || $salari === 'si' || $salari === 'yes' || $salari === 's');

            $scuola = $factory::create($nome, null, $salari);
            $repository->addScuola($scuola);
            $continue = $this->ask("Aggiungere un altra scuola: y/n");
        } while($continue === 'y' || $continue === 'si' || $continue === 'yes' || $continue === 's');
    }
}
