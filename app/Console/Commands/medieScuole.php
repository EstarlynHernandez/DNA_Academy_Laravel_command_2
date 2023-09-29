<?php

namespace App\Console\Commands;

use App\Management\scuolaManagement;
use App\Repository\ScuolaRepository;
use Illuminate\Console\Command;

class medieScuole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:medie';

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
        foreach ($repository->getAll() as $scuola) {
            $studenti = $management->studenti($scuola->codice);
            $media = [];
            foreach ($studenti as $studente) {
                $media[] = array_sum($studente->voti) / count($studente->voti);
            }

            $this->line("--------------------------------------------");
            $this->line("Codice: $scuola->codice | Nome: $scuola->nome | Media Voti: " .
                number_format(array_sum($media) / (count($media) > 0 ? count($media) : 1), 2));
            $this->line("--------------------------------------------");
        }
    }
}
