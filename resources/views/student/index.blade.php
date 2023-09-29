<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
    <theader>
        <th>Matricola</th>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Media Voti</th>
    </theader>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->matricola }}</td>
            <td>{{ $student->nome }}</td>
            <td>{{ $student->cognome }}</td>
            <td>
                {{ number_format((($student->voti[0] + $student->voti[1] +$student->voti[2]) / 3), 2) }}
            </td>
            <td>
                <form method="POST" action="{{ route('student.delete') }}">
                    @csrf
                    @method('delete')
                    <input hidden name="matricola" value="{{ $student->matricola }}">
                    <input type="submit" value="Elimina">
                </form>
            </td>
        </tr>
    @endforeach
    <tr>
        <form action="">
            <td><input type="text" placeholder="Matricola" disabled></td>
            <td><input type="text" placeholder="Nome"></td>
            <td><input type="text" placeholder="Cognome"></td>
            <td></td>
            <td><input type="submit" value="Add"></td>
        </form>
    </tr>
</table>
</body>
</html>
