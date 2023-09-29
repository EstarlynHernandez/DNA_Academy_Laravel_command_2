<?php

namespace App\Factory;

use App\Models\School;

class ScuolaFactory
{
    public static function create($nome, $codice = null, $salary = null)
    {
        $scuola = new School();
        $scuola->nome = $nome;
        $scuola->codice = $codice ?? uniqid();
        $scuola->salari = $salary ?? [];

        return $scuola;
    }
}
