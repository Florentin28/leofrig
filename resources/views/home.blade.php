<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leofrig - Accueil</title>
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
            text-align: center;
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


.alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px; /* Espacement en haut du message */
        width: 80%; /* Ajout de la largeur */
        text-align: center;
    }

    /* Styles pour le bouton d'ajout */
    .ajout-btn {
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        margin-top: 20px; /* Espacement en haut */
        display: inline-block;
    }

    .ajout-btn:hover {
        background-color: #218838;
    }

    .temperature {
            color: inherit; /* Couleur de texte par défaut */
            font-weight: 700; /* Légèrement plus gras */

        }

        .temperature.tmp-ok-0 {
            background-color: red; /* Fond rouge pour les températures non valides */
        }

        .temperature.tmp-ok-1 {
            background-color: green; /* Fond vert pour les températures valides */
        }

        .humidity {
    color: inherit;
    font-weight: 700;
}

.humidity.hum-ok-0 {
    background-color: red;
}

.humidity.hum-ok-1 {
    background-color: green;
}

.filter-container {
    margin-bottom: 20px; /* Espacement en bas */
}

.filter-link {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin-right: 10px; /* Espacement entre les boutons */
}

.filter-link:hover {
    background-color: #0056b3;
}

.filter-link.active {
    background-color: #0056b3; /* Couleur de fond active */
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

    <!-- Choix entre historique et aujourd'hui -->
    <div class="filter-container">
    <a href="{{ route('home', ['filter' => 'historique']) }}" class="filter-link {{ request('filter') == 'historique' ? 'active' : '' }}">Historique</a>
    <a href="{{ route('home', ['filter' => 'aujourd_hui']) }}" class="filter-link {{ request('filter') == 'aujourd_hui' ? 'active' : '' }}">Aujourd'hui</a>
</div>



    <!-- Affichage des données de la table "releves" -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Succursale</th>
                    <th>Local</th>
                    <th>Date</th>
                    <th>Moment</th>
                    <th>Température</th>
                    <th>Humidité</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
                @foreach($releves as $releve)
                    <tr>
                        <td>{{ $releve->id }}</td>
                        <td>{{ $releve->succursale->Nom }}</td>
                        <td>{{ $releve->local->description }}</td>
                        <td>{{ date('Y-m-d', strtotime($releve->id_datetime)) }}</td>
                        <td>{{ $releve->id_moment }}</td>
                        <td class="temperature tmp-ok-{{ $releve->tmp_ok }}">{{ $releve->releve_temp }}</td>
                        <td class="humidity hum-ok-{{ $releve->hum_ok }}">{{ $releve->releve_hum }}</td>
                        <td>{{ $releve->releve_comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bouton d'ajout -->
<a href="{{ route('nouveau_releve') }}" class="ajout-btn">Ajouter du contenu</a>

<!-- Affichage de la pagination -->
@if ($releves->lastPage() > 1)
    <div class="pagination">
        <!-- Bouton "Page précédente" -->
        @if ($releves->onFirstPage())
            <span>&laquo;</span>
        @else
            <a href="{{ $releves->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        <!-- Boutons de pagination -->
        @for ($i = 1; $i <= $releves->lastPage(); $i++)
            <!-- Affichage uniquement si une seule page est disponible ou si la page actuelle est la première, la dernière ou est à deux pages de distance -->
            @if ($releves->lastPage() == 1 || $i == 1 || $i == $releves->currentPage() || $i == $releves->lastPage() || abs($releves->currentPage() - $i) <= 2)
                <!-- Bouton de la page actuelle -->
                @if ($i == $releves->currentPage())
                    <span>{{ $i }}</span>
                @else
                    <!-- Liens vers les autres pages -->
                    <a href="{{ $releves->url($i) }}">{{ $i }}</a>
                @endif
            @endif
        @endfor

        <!-- Bouton "Page suivante" -->
        @if ($releves->hasMorePages())
            <a href="{{ $releves->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <span>&raquo;</span>
        @endif
    </div>
@endif




 
</body>
</html>
