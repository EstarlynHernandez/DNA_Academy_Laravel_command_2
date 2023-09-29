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
        <th>Action</th>
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
            <td>
                <form method="POST" action="{{ route('school.delete') }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="scuola" value="{{ $scuola->codice }}">
                    <input type="submit" value="Elimina">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
