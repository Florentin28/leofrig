<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leofrig - Accueil</title>
    <style>
 /* Styles CSS existants */

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

.logout-btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin-bottom: 20px;
}

.logout-btn:hover {
    background-color: #0056b3;
}

.table-container {
    max-height: 400px; /* Limite la hauteur de la table */
    overflow-y: auto; /* Ajoute une barre de défilement verticale */
    width: 80%; /* Ajout de la largeur */
    margin-bottom: 20px; /* Espacement en bas */
}

table {
    border-collapse: collapse;
    width: 100%; /* 100% de la largeur de la table-container */
}

/* Styles pour les cellules de tableau */
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

/* Styles pour les titres de colonnes */
th {
    position: sticky;
    top: 0;
    background-color: #f2f2f2;
    margin-top: 5px; /* Compenser l'écart lors du défilement rapide */
}




.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.pagination a {
    padding: 5px 10px;
    margin: 0 5px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
}

.pagination a:hover {
    background-color: #0056b3;

}
    </style>
</head>
<body>
    <h1>Leofrig partie user</h1>
    <!-- Bouton de déconnexion -->
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="logout-btn">Déconnexion</button>
    </form>
    
     <!-- Affichage du message de succès -->
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Affichage des données de la table "releves" -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                        <td>{{ $releve->id_succ }}</td>
                        <td>{{ $releve->id_local }}</td>
                        <td>{{ $releve->id_datetime }}</td>
                        <td>{{ $releve->id_moment }}</td>
                        <td>{{ $releve->releve_temp }}</td>
                        <td>{{ $releve->releve_hum }}</td>
                        <td>{{ $releve->releve_comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bouton d'ajout -->
<a href="{{ route('nouveau_releve') }}" class="ajout-btn">Ajouter du contenu</a>


    <!-- Pagination -->
    <div class="pagination">
        {{ $releves->links() }}
    </div>
</body>
</html>
