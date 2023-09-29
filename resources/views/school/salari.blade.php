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
        <th>Salary</th>
    </tr>
    </thead>
    <tbody>
    @foreach($scuole as $scuola)
        <tr>
            <td>{{ $scuola->codice }}</td>
            <td>{{ $scuola->nome }}</td>
            <td>
                {{ array_sum($scuola->salari) / count($scuola->salari) }}
            </td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td> Media Totale:</td>
        <td>{{ $mediaSalari }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
