<?php

namespace App\Management;

use App\Models\School;
use App\Models\Studente;
use App\Repository\ScuolaRepository;
use App\Repository\StudentiRepository;

class scuolaManagement
{
    private ScuolaRepository $repository;
    private studentManagement $studentManagement;

    public function __construct(ScuolaRepository $repository, studentManagement $studentManagement)
    {
        $this->repository = $repository;
        $this->studentManagement = $studentManagement;
    }

    public function mediaSalary(): string
    {
        $scuole = $this->repository->getAll();
        $salariCount = 0;
        $salari = 0;
        /**
         * @var School $scuola
         */
        foreach ($scuole as $scuola) {
            $salariCount += count($scuola->salari);
            $salari += array_sum($scuola->salari);
        }

        return number_format($salari / $salariCount, 2);
    }

    public function mediaSalaryOne($school): float
    {
        try {
            $scuole = $this->repository->getScuola($school);
            $salariCount = 0;
            $salari = 0;
            /**
             * @var School $scuola
             */
            foreach ($scuole as $scuola) {
                $salariCount += count($scuola->salari);
                $salari += array_sum($scuola->salari);
            }

            return number_format($salari / $salariCount, 2);
        } catch (\Exception $e) {
            return 0;
        }
    }



    public function studenti($scuola)
    {
        $studentiRepo = new StudentiRepository();
        return $studentiRepo->getFromSchool($scuola);
    }

    public function bestStudent($scuola): ?Studente
    {
        $studenti = $this->studenti($scuola);
        $bestStudent = null;
        /***
         * @var Studente $studente
         */
        foreach ($studenti as $studente) {
            if ($bestStudent == null) {
                $bestStudent = $studente;
            }

            if (array_sum($studente->voti) > array_sum($bestStudent->voti)) {
                $bestStudent = $studente;
            }
        }

        return $bestStudent;
    }

    public function mediaVoti($scuola) {
        $studenti = $this->studenti($scuola->codice);

        return $this->studentManagement->mediaVotiScuola($studenti);
    }
}
