<?php

namespace App\Http\Controllers;

use App\Management\scuolaManagement;
use App\Repository\ScuolaRepository;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(ScuolaRepository $repository, scuolaManagement $management)
    {
        $scuole = $repository->getAll();
        return view('school/index', ['scuole' => $scuole, 'management' => $management]);
    }

    public function destroy(ScuolaRepository $repository, Request $request)
    {
        $repository->deleteScuola($request['scuola']);
        return redirect()->route('school.index');
    }

    public function mediaSalari(ScuolaRepository $repository, scuolaManagement $management)
    {
        $scuole = $repository->getAll();
        $mediaSalari = $management->mediaSalary();
        return view('school/salari', ['scuole' => $scuole, 'mediaSalari' => $mediaSalari]);
    }

    public function mediaScuola(ScuolaRepository $repository, scuolaManagement $management)
    {
        $scuole = $repository->getAll();
        $result = [];
        foreach ($scuole as $scuola) {
            $result[] = [
                'scuola' => $scuola,
                'studente' => $management->bestStudent($scuola->codice),
                'mediaVoti' => $management->mediaVoti($scuola)
            ];
        }
        return view('school/media', ['scuole' => $scuole, 'schools' => $result]);
    }
}
