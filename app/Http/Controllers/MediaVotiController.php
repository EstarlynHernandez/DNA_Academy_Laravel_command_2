<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\StudentiRepository;

class MediaVotiController extends Controller
{
    public function index(StudentiRepository $repository)
    {

        $students = $repository->getStudents();

        $voti = 0;
        $count = 0;
        foreach ($students as $student) {
            foreach ($student->voti as $voto) {
                $voti += $voto;
                $count++;
            }
        }

        $mediaVoti = number_format($voti / $count, 2);

        return view('voti/index', compact('mediaVoti'));
    }

}
