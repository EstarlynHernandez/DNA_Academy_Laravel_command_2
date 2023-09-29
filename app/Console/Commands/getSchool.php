<?php

namespace App\Console\Commands;

use App\Management\scuolaManagement;
use App\Models\School;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class getSchool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-school';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScuolaRepository $repository, scuolaManagement $management)
    {
        do {
            $condition = 'n';
            try {
                $codice = $this->ask("Qual'e il codice della scuola");
                $school = $repository->getScuola($codice);

                $this->line("Codice: $school->codice | Nome: $school->nome | Salary: " . json_encode($school->salari));
            } catch (\Exception $e) {
                $condition = $this->ask("Vuoi cercare un'altra scuola 'y/n'");
            }
        } while ($condition === 'y' || $condition === 'si' || $condition === 'yes' || $condition === 's');
    }
}
