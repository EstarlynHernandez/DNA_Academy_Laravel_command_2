<?php

namespace App\Repository;

use App\Factory\StudentiFactory;
use App\Models\Studente;
use Exception;
use Illuminate\Support\Arr;

class StudentiRepository
{
    protected array $studenti;

    public function __construct()
    {
        $this->getFromCsv();
    }

    private function getFromCsv(): void
    {
        $this->studenti = [];
        $path = storage_path() . '/School/Student/studenti.csv';
        if (file_exists($path)) {
            $directory = fopen($path, 'r+');

            while (($data = fgetcsv($directory, 0)) !== false) {
                $student = StudentiFactory::create([
                    'matricola' => Arr::get($data, 0),
                    'nome' => Arr::get($data, 1),
                    'cognome' => Arr::get($data, 2),
                    'voti' => json_decode(Arr::get($data, 3)) ?? [],
                    'codice_scuola' => Arr::get($data, 4),
                ]);
                $this->studenti[] = $student;
            }

            fclose($directory);
        }
    }

    public function saveStudent(Studente $studente): void
    {
        $studente->matricola = $studente->id ?? uniqid();
        $this->studenti[] = $studente;
        $this->saveInCsv();
    }

    private function saveInCsv(): void
    {
        $pathStudent = storage_path() . '/School/Student/studenti.csv';
        $directoryStudent = fopen($pathStudent, 'w+');

        /**
         * @var Studente $student
         */
        foreach ($this->studenti as $student) {
            fputcsv($directoryStudent, [$student->matricola,
                $student->nome,
                $student->cognome,
                json_encode($student->voti),
                $student->scuola
            ]);
        }

        fclose($directoryStudent);
    }

    /**
     * @throws Exception
     */
    public function getStudent($matricola): Studente
    {
        $studente = Arr::first($this->studenti, fn($key) => $key->matricola == $matricola);
        if ($studente) {
            return $studente;
        }

        throw new Exception("studente non trovato");
    }

    public function getStudents(): array
    {
        return $this->studenti;
    }

    public function getFromSchool($schoolCode): array
    {
        $studenti = [];
        /**
         * @var Studente $studente
         */
        foreach ($this->studenti as $studente) {
            if ($studente->scuola === $schoolCode) {
                $studenti[] = $studente;
            }
        }
        return $studenti;
    }

    public function deleteStudente(Studente|string $oldStudente): void
    {
        $matricola = $oldStudente->matricola ?? $oldStudente;
        /**
         * @var  Studente $studente
         */
        foreach ($this->studenti as $key => $studente) {
            if ($studente->matricola == $matricola) {
                unset($this->studenti[$key]);
                $voti = storage_path() . "/School/Voti/$matricola.csv";
                if (file_exists($voti)) {
                    unlink($voti);
                }
            }
        }

        $this->saveInCsv();
    }

    public function aggiornaStudente($newStudente)
    {
        /**
         * @var Studente $studente
         */
        foreach ($this->studenti as $key => $studente) {
            if ($studente->matricola == $newStudente->matricola) {
                $this->studenti[$key] = $newStudente;
            }
        }

        $this->saveInCsv();
    }
}
