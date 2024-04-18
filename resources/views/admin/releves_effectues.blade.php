<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relevés effectués</title>
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
    <h1>Relevés effectués</h1>

    <!-- Bouton pour retourner à la page admin -->
    <a href="{{ route('admin.index') }}">Retour à la page admin</a>

    <!-- Formulaire de sélection de succursale -->
        <form action="{{ route('admin.relevesEffectues') }}" method="GET" id="filterForm">
            <label for="succursale">Sélectionner une succursale :</label>
            <select name="succursale" id="succursale">
    <option value="">Toutes les succursales</option>
    @isset($succursales)
        @foreach($succursales as $succursale)
            <option value="{{ $succursale->id }}">{{ $succursale->Nom }}</option>
        @endforeach
    @endisset
</select>

        <button type="button" id="filterButton">Filtrer</button>
    </form>

    <!-- Tableau des relevés -->
    <table>
        <thead>
            <tr>
                <th>Pays</th>
                <th>Numéro de la succursale</th>
                <th>Nom de la succursale</th>
                <th>Date du relevé</th>
                <th>Nom du local</th>
                <th>Matin</th>
                <th>Après-midi</th>
                <th>Soir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($releves_effectues->sortByDesc('id_datetime') as $releve)
                <tr>
                    <td>{{ $releve->succursale ? $releve->succursale->Pays : 'N/A' }}</td>
                    <td>{{ $releve->succursale ? $releve->succursale->id : 'N/A' }}</td>
                    <td>{{ $releve->succursale ? $releve->succursale->Nom : 'N/A' }}</td>
                    <td>{{ $releve->id_datetime }}</td>
                    <td>{{ $releve->local->description }}</td>
                    <td class="{{ $releve->releve_temp_matin ? 'yes' : 'no' }}">{{ $releve->releve_temp_matin ? 'Oui' : 'Non' }}</td>
                    <td class="{{ $releve->releve_temp_midi ? 'yes' : 'no' }}">{{ $releve->releve_temp_midi ? 'Oui' : 'Non' }}</td>
                    <td class="{{ $releve->releve_temp_soir ? 'yes' : 'no' }}">{{ $releve->releve_temp_soir ? 'Oui' : 'Non' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.querySelector('#filterButton').addEventListener('click', function(event) {
            document.querySelector('#filterForm').submit();

            
        });
    </script>

</body>
</html>
