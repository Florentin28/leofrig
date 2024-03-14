<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un relevé</title>
</head>
<body>
    <div>
        <h1>Ajouter un relevé</h1>

        <form action="{{ route('releves.store') }}" method="POST">
            @csrf

            <!-- Champs du formulaire -->

            <div>
    <label for="id_succ">Identifiant de la succursale :</label>
    <input type="text" name="id_succ" id="id_succ" value="{{ $user->id_succ }}">
</div>

<div>
    <label for="id_datetime">Date :</label>
    <input type="date" name="id_datetime" id="id_datetime">
</div>

<div>
    <label for="id_local">Local :</label>
    <select name="id_local" id="id_local">
        @foreach ($locaux as $local)
            @if ($local->id_succ == $user->id_succ)
                <option value="{{ $local->id }}">{{ $local->description }}</option>
            @endif
        @endforeach
    </select>
</div>

<div>
    <label for="id_moment">Moment de la journée :</label>
    <select name="id_moment" id="id_moment">
        <option value="Matin">Matin</option>
        <option value="Après-midi">Après-midi</option>
        <option value="Soir">Soir</option>
    </select>
</div>


            <div>
                <label for="releve_temp">Température :</label>
                <input type="text" name="releve_temp" id="releve_temp">
            </div>

            <div>
                <label for="releve_hum">Taux d'humidité :</label>
                <input type="text" name="releve_hum" id="releve_hum">
            </div>

            <div>
                <label for="releve_comment">Commentaire :</label>
                <textarea name="releve_comment" id="releve_comment"></textarea>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit">Ajouter Relevé</button>
        </form>
    </div>
</body>
</html>
