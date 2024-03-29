<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplacements à Relever</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td.active {
            background-color: green;
            color: white;
        }
        td.inactive {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Emplacements à Relever</h1>

    <!-- Tableau des emplacements à relever -->
    <table>
        <thead>
            <tr>
                <th>ID Local</th>
                <th>Numéro de Succursale</th>
                <th>Nom de Succursale</th>
                <th>Description du Local</th>
                <th>Actif</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($locaux as $local)
    <tr>
        <td>{{ $local->id }}</td>
        @if ($local->succursale)
            <td>{{ $local->succursale->id }}</td>
            <td>{{ $local->succursale->nom }}</td>
            <td>{{ $local->description }}</td>
            <td>{{ $local->actif ? 'Oui' : 'Non' }}</td>
            <td>{{ $local->succursale->pays }}</td>
        @else
            <td>N/A</td>
            <td>N/A</td>
            <td>{{ $local->description }}</td>
            <td>{{ $local->actif ? 'Oui' : 'Non' }}</td>
            <td>N/A</td>
        @endif
    </tr>
@endforeach


        </tbody>
    </table>

</body>
</html>
