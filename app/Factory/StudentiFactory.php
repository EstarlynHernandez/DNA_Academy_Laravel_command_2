<?php

namespace App\Factory;

use App\Models\Studente;
use Illuminate\Support\Arr;

class StudentiFactory
{
    public static function create($param): Studente
    {
        $student = new Studente();
        $student->matricola = Arr::get($param, 'matricola', '');
        $student->nome = Arr::get($param, 'nome', '');
        $student->cognome = Arr::get($param, 'cognome', '');
        $student->voti = Arr::get($param, 'voti', []);
        $student->scuola = Arr::get($param, 'codice_scuola', '');

        return $student;
    }
}
