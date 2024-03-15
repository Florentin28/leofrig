<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un relevé</title>
    <style>
    /* Styles CSS existants */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f0f0f0;
    }

    h1 {
        font-size: 3rem;
        margin-top: 20px;
    }

    .form-container {
        width: 80%; /* Ajout de la largeur */
        margin-top: 20px; /* Espacement en haut */
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea,
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box; /* Pour inclure le padding dans la largeur totale */
    }

    select {
        appearance: none; /* Retirer la flèche par défaut sur les menus déroulants */
    }

    /* Styles pour le bouton de soumission */
    button[type="submit"] {
        padding: 12px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .table-container {
        max-height: 400px; /* Limite la hauteur de la table */
        overflow-y: auto; /* Ajoute une barre de défilement verticale */
        width: 80%; /* Ajout de la largeur */
        margin-top: 40px; /* Espacement en haut */
    }

    table {
        border-collapse: collapse;
        width: 100%; /* 100% de la largeur de la table-container */
    }

    /* Styles pour les cellules de tableau */
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    /* Styles pour les titres de colonnes */
    th {
        position: sticky;
        top: 0;
        background-color: #f2f2f2;
        margin-top: 5px; /* Compenser l'écart lors du défilement rapide */
        font-weight: bold;
        padding: 12px;
    }

    /* Styles pour les boutons radio */
    input[type="radio"] {
        transform: scale(1.3); /* Ajuste la taille du bouton radio */
        margin-bottom: 10px; /* Espacement entre les boutons radio */
    }

    .temperature,
    .humidity {
        font-weight: bold;
    }

    .temperature.tmp-ok-0,
    .humidity.hum-ok-0 {
        background-color: red;
    }

    .temperature.tmp-ok-1,
    .humidity.hum-ok-1 {
        background-color: green
    }
</style>

</head>
<body>
    <div>
        <h1>Ajouter un relevé</h1>

        <!-- Formulaire de création d'un relevé -->
        <div class="form-container">
            <form action="{{ route('releves.store') }}" method="POST">
                @csrf

                <!-- Champs du formulaire -->
   


                <div>
                    <label for="id_datetime">Date :</label>
                    <input type="date" name="id_datetime" id="id_datetime" required>
                </div>

                <div>
                    <label for="id_local">Local :</label>
                    <select name="id_local" id="id_local">
                        @foreach ($locaux as $local)
                            @if ($local->id_succ == $user->id_succ)
                                <option value="{{ $local->id }}" required>{{ $local->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div>
    <label for="id_moment">Moment de la journée :</label>
    <div>
        <input type="radio" id="matin" name="id_moment" value="Matin" required>
        <label for="matin">Matin</label>
    </div>
    <div>
        <input type="radio" id="apres_midi" name="id_moment" value="Après-midi">
        <label for="apres_midi">Après-midi</label>
    </div>
    <div>
        <input type="radio" id="soir" name="id_moment" value="Soir">
        <label for="soir">Soir</label>
    </div>
</div>



<div>
    <label for="releve_temp">Température :</label>
    <input type="number" name="releve_temp" id="releve_temp" required min="-50" max="100">
</div>

<div>
    <label for="releve_hum">Taux d'humidité :</label>
    <input type="number" name="releve_hum" id="releve_hum" required min="0" max="100">
</div>


                <div>
    <label for="releve_comment">Commentaire :</label>
    <textarea name="releve_comment" id="releve_comment" maxlength="100"></textarea>
</div>


                <!-- Bouton de soumission -->
                <button type="submit">Ajouter Relevé</button>
            </form>
        </div>
    </div>

    <!-- Tableau des données de la base de données -->
    <div class="table-container">
        <h2>Liste des relevés</h2>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>ID Succ</th>
                    <th>ID Local</th>
                    <th>ID Datetime</th>
                    <th>ID Moment</th>
                    <th>Relevé Temp</th>
                    <th>Relevé Hum</th>
                    <th>Relevé Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($releves as $releve)
                    <tr>
                        <td>{{ $releve->id }}</td>
                        <td>{{ $releve->succursale->Nom }}</td>
                        <td>{{ $releve->local->description }}</td>
                        <td>{{ $releve->id_datetime }}</td>
                        <td>{{ $releve->id_moment }}</td>
                        <td class="temperature tmp-ok-{{ $releve->tmp_ok }}">{{ $releve->releve_temp }}</td>
                        <td class="humidity hum-ok-{{ $releve->hum_ok }}">{{ $releve->releve_hum }}</td>
                        <td>{{ $releve->releve_comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
