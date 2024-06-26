<!DOCTYPE html>
<html lang="@yield('lang', 'fr')">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        /* Styles CSS existants */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f2f2f2; /* Gris clair */
        }

        h1 {
            font-size: 3rem;
            margin-top: 20px;
        }

        .logout-btn {
            padding: 12px 24px;
            background-color: #dc3545; /* Rouge */
            color: #fff;
            border: 2px solid #dc3545; /* Bordure rouge */
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 10px;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s; /* Transition fluide */
        }

        .logout-btn:hover {
            background-color: #c82333; /* Rouge plus foncé au survol */
            border-color: #c82333; /* Bordure rouge plus foncée au survol */
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
            border: 1px solid black;
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

        /* Styles pour le bouton de déconnexion */
        .logout-btn {
            padding: 10px 20px;
            background-color: #dc3545; /* Rouge */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .logout-btn:hover {
            background-color: #c82333; /* Rouge plus foncé au survol */
        }

        /* Styles pour le bouton d'ajout */
        .ajout-btn {
            padding: 12px 24px;
            background-color: #28a745; /* Vert */
            color: #fff;
            border: 2px solid #28a745; /* Bordure verte */
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px; /* Espacement en haut */
            display: inline-block;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s; /* Transition fluide */
        }

        .ajout-btn:hover {
            background-color: darkgreen; /* Vert plus foncé au survol */
            border-color: darkgreen; /* Bordure verte plus foncée au survol */
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
            margin-top: 20px;
            margin-bottom: 20px; /* Ajout d'espace en bas des boutons */
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

        .language-btn-container {
    margin-top: 20px; /* Espacement au-dessus des boutons */
    margin-bottom: 20px; /* Espacement en dessous des boutons */
}

.language-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin-right: 10px;
    font-size: 16px;
    
}

.language-btn.fr {
    background-color: #007bff; /* Bleu */
    color: #fff;
    background-color: #6f42c1; /* Violet */

}

.language-btn.nl {
    background-color: #28a745; /* Vert */
    color: #fff;
    background-color: #6f42c1; /* Violet */

}

.language-btn:hover {
    opacity: 0.8; /* Réduit légèrement l'opacité au survol */
}


    </style>
</head>
<body>
  

    <h1>@lang('messages.header')</h1>

    <!-- Bouton de déconnexion -->
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="logout-btn">@lang('messages.logout')</button>
    </form>
    
    <!-- Affichage du message de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

      <!-- Ajoutez le menu pour choisir la langue ici -->
      <div class="language-btn-container">
    <a href="{{ route('lang.switch', 'fr') }}" class="language-btn fr">Français</a>
    <a href="{{ route('lang.switch', 'nl') }}" class="language-btn nl">Néerlandais</a>
</div>




    <!-- Choix entre historique et aujourd'hui -->
    <div class="filter-container">
        <a href="{{ route('home', ['filter' => 'historique']) }}" class="filter-link {{ request('filter') == 'historique' ? 'active' : '' }}">@lang('messages.history')</a>
        <a href="{{ route('home', ['filter' => 'aujourd_hui']) }}" class="filter-link {{ request('filter') == 'aujourd_hui' ? 'active' : '' }}">@lang('messages.today')</a>
    </div>

    <!-- Affichage des données de la table "releves" -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>@lang('messages.number')</th>
                    <th>@lang('messages.branch')</th>
                    <th>@lang('messages.location')</th>
                    <th>@lang('messages.date')</th>
                    <th>@lang('messages.moment')</th>
                    <th>@lang('messages.temperature')</th>
                    <th>@lang('messages.humidity')</th>
                    <th>@lang('messages.comment')</th>
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
    <a href="{{ route('nouveau_releve') }}" class="ajout-btn">@lang('messages.add_content')</a>

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
