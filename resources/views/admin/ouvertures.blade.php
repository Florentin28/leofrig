<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ouvertures</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f0f0f0;
            }

            h1 {
                font-size: 2rem;
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

            .menu {
                float: left;
                margin-right: 20px;

                list-style-type: none;
        padding: 0;
        max-height: 200px; /* Ajustez la hauteur maximale selon vos besoins */
        overflow-y: auto; /* Ajoute un défilement vertical si nécessaire */
        border: 1px solid #ccc; /* Ajoute une bordure autour de la liste */
        border-radius: 5px; /* Ajoute un arrondi aux coins de la liste */
        background-color: #fff; /* Définit la couleur de fond de la liste */
            }

            .menu ul {
                list-style-type: none;
                padding: 0;
            }

            .menu ul li {
                margin-bottom: 5px;
        padding: 10px;
            }

            .menu ul li a {
                text-decoration: none;
                color: #007bff;
            
        display: block;
            }

            .menu ul li a:hover {
                text-decoration: underline;
                background-color: #f2f2f2; /* Change la couleur de fond lors du survol */

            }
        </style>
    </head>
    <body>
        <h1>Ouvertures</h1>

    
        <!-- Bouton de déconnexion -->
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>

    <!-- Menu des succursales -->
    <div class="menu">
        <h2>Succursales</h2>
        <ul>
            @foreach($locaux as $local) 
                <li><a href="{{ route('admin.show', ['id' => $local->id]) }}" data-local-id="{{ $local->id }}">{{ $local->Nom }}</a></li>
            @endforeach
            <li><a href="{{ route('admin.index') }}">Toutes les succursales</a></li>
        </ul>
    </div>
    <!-- Bouton pour afficher les relevés effectués -->
        <a href="{{ route('releves_effectues') }}" class="btn">Relevés effectués</a>
    </div>

    <a href="{{ route('emplacements_a_relever') }}" class="btn-home">Emplacements à Relever</a>

    <a href="{{ route('ouvertures') }}" class="btn-home-2">Ouvertures</a>



    <!-- Tableau des relevés -->
    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Numéro de la succursale</th>
                <th>Nom de la succursale</th>
                <th>ID du local</th>
                <th>Nom du local</th>
                <th>Date du relevé</th>
                <th>Moment de la journée</th>
                <th>Température</th>
                <th>Taux d'humidité</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            @if($releves->isEmpty())
                <tr>
                    <td colspan="10">Pas de relevés</td>
                </tr>
            @else
                @foreach($releves as $releve)
                <tr>
                    <td>{{ $releve->id }}</td>
                    <td>{{ $releve->succursale->id }}</td>
                    <td>{{ $releve->succursale->Nom }}</td>
                    <td>{{ $releve->local->id }}</td>
                    <td>{{ $releve->local->description }}</td>
                    <td>{{ $releve->id_datetime }}</td>
                    <td>{{ $releve->id_moment }}</td>
                    <td class="{{ $releve->tmp_ok ? 'yes' : 'no' }}">{{ $releve->releve_temp }}</td>
                    <td class="{{ $releve->hum_ok ? 'yes' : 'no' }}">{{ $releve->releve_hum }}</td>
                    <td>{{ $releve->releve_comment }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>




    <script>
        console.log("Page chargée.");

        // Détection du clic sur un lien de succursale
        document.querySelectorAll('.menu ul li a').forEach(link => {
        link.addEventListener('click', function(event) {
            let localId = this.getAttribute('data-local-id');
            fetch(`/admin?local_id=${localId}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Relevés de la succursale:", data);
                })
                .catch(error => console.error('Erreur lors de la récupération des relevés:', error));
        });
    });

    </script>

    </body>
    </html>
