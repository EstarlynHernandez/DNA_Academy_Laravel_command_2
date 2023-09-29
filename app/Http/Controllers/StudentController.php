<?php

namespace App\Http\Controllers;

use App\Models\Studente;
use App\Repository\StudentiRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(StudentiRepository $repository)
    {
        $students = $repository->getStudents();
        return view('student/index', ['students' => $students]);
    }

    public function destroy(StudentiRepository $repository, Request $request)
    {
        $repository->getStudent($request['matricola']);
        $repository->deleteStudente($request['matricola']);
        return redirect()->route('student.index');
    }

    public function mediaSalary(StudentiRepository $repository, Request $request)
    {
        $repository->getStudent($request['matricola']);
        $repository->deleteStudente($request['matricola']);
        return redirect()->route('student.index');
    }
}
