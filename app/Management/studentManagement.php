<?php

namespace App\Management;

use App\Repository\ScuolaRepository;
use App\Repository\StudentiRepository;

class studentManagement
{
    public StudentiRepository $repository;
    private ScuolaRepository $scuolaRepository;

    public function __construct(StudentiRepository $studentiRepository, ScuolaRepository $scuolaRepository)
    {
        $this->repository = $studentiRepository;
        $this->scuolaRepository = $scuolaRepository;
    }

    public function mediaVoti(): float
    {
        $students = $this->repository->getStudents();
        $voti = 0;
        $count = 0;
        foreach ($students as $student) {
            $voti += array_sum($student->voti);
            $count += count($student->voti);
        }

        return number_format($voti / $count, 2);
    }

    public function mediaVotiScuola($students): float
    {
        $voti = 0;
        $count = 0;
        foreach ($students as $student) {
            $voti += array_sum($student->voti);
            $count += count($student->voti);
        }

        return number_format($voti / ($count > 0 ? $count : 1), 2);
    }

    public function scuola($scuola)
    {
        return $this->scuolaRepository->getScuola($scuola);
    }
}
