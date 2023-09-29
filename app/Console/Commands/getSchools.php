<?php

namespace App\Console\Commands;

use App\Management\scuolaManagement;
use App\Models\School;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class getSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:all';

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
        $schools = $repository->getAll();

        /**
         * @var School $school
         */
        foreach ($schools as $school) {
            $this->line("Codice: $school->codice | Nome: $school->nome | Salary: " . json_encode($school->salari));
        }

        $this->line("La media di salario delle scuole e di " . $management->mediaSalary());
    }
}
