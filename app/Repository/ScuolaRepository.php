<?php

namespace App\Repository;

use App\Factory\ScuolaFactory;
use App\Factory\StudentiFactory;
use App\Models\School;

class ScuolaRepository
{
    private string $path;
    private array $scuole;
    private ScuolaFactory $factory;
    private StudentiRepository $studentiRepository;

    public function __construct(ScuolaFactory $factory)
    {
        $this->factory = $factory;
        $this->path = storage_path() . "/school.csv";
        $this->getFromCsv();
    }

    public function getAll(): array
    {
        return $this->scuole;
    }

    public function getScuola($codice): School
    {
        /**
         * @var School $scuola
         */
        foreach ($this->scuole as $scuola) {
            if ($scuola->codice === $codice) {
                return $scuola;
            }
        }

        throw new \Exception("scuola non trovata");
    }

    public function deleteScuola($codice): bool
    {
        $delete = false;
        /**
         * @var School $scuola
         */
        foreach ($this->scuole as $key => $scuola) {
            if ($scuola->codice === $codice) {
                unset($this->scuole[$key]);
                $delete = true;
            }
        }

        $this->saveInCsv();

        return $delete;
    }

    public function updateScuola($newScuola)
    {
        /**
         * @var School $scuola
         */
        foreach ($this->scuole as $key => $scuola) {
            if ($scuola->codice === $newScuola->codice) {
                $this->scuole[$key] = $newScuola;
            }
        }

        $this->saveInCsv();
    }

    public function addScuola(School $scuola): void
    {
        $this->scuole[] = $scuola;
        $this->saveInCsv();
    }

    public function getStudents($codiceScuola): array
    {
        return $this->studentiRepository->getFromSchool($codiceScuola);
    }

    private function getFromCsv(): void
    {
        $this->scuole = [];
        if (file_exists($this->path)) {
            $directory = fopen($this->path, 'r+');

            while (($data = fgetcsv($directory, 0)) !== false) {
                $scuola = $this->factory::create($data[1], $data[0], json_decode($data[2]));
                $this->scuole[] = $scuola;
            }

            fclose($directory);
        }
    }

    private function saveInCsv(): void
    {
        $directoryStudent = fopen($this->path, 'w+');
        /**
         * @var School $scuola
         */
        foreach ($this->scuole as $scuola) {
            fputcsv($directoryStudent, [$scuola->codice, $scuola->nome, json_encode($scuola->salari)]);
        }

        fclose($directoryStudent);
    }
}
