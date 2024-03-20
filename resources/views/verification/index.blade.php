<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification des relevés</title>
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
        td.yes {
            background-color: green;
            color: white;
        }
        td.no {
            background-color: red;
            color: white;
        }
        .btn-home {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Vérification des relevés</h1>

    <table>
        <thead>
            <tr>
                <th>Local</th>
                <th>Matin</th>
                <th>Après-midi</th>
                <th>Soir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locaux as $local)
                <tr>
                    <td>{{ $local->description }}</td>
                    <td class="{{ $local->checkReleve($date, 'Matin') ? 'yes' : 'no' }}">{{ $local->checkReleve($date, 'Matin') ? 'Oui' : 'Non' }}</td>
                    <td class="{{ $local->checkReleve($date, 'Après-midi') ? 'yes' : 'no' }}">{{ $local->checkReleve($date, 'Après-midi') ? 'Oui' : 'Non' }}</td>
                    <td class="{{ $local->checkReleve($date, 'Soir') ? 'yes' : 'no' }}">{{ $local->checkReleve($date, 'Soir') ? 'Oui' : 'Non' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('nouveau_releve') }}" class="btn-home">Retourner à la page Create</a>
</body>
</html>
