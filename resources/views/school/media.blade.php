<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Codice</th>
        <th>Nome</th>
        <th>Miglior Studente</th>
        <th>Voto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($schools as $school)
        <tr>
            <td>{{ $school['scuola']->codice }}</td>
            <td>{{ $school['scuola']->nome }}</td>
            <td>{{ $school['studente']->nome ?? 'no trovato' }}</td>
            <td>{{
                isset($school['studente']->voti) ?
                number_format(array_sum($school['studente']->voti) / count($school['studente']->voti), 2) :
                'no trovato'
            }}</td>
            <td>{{ $school['mediaVoti'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
