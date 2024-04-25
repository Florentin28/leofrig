    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BackOffice</title>
        <style>
          body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #f2f2f2; /* Gris clair */
}

h1 {
    font-size: 3rem;
    margin-top: 20px;
}

table {
    width: 80%; /* Largeur ajustée */
    border-collapse: collapse;
    margin-top: 20px;
    max-height: 400px; /* Hauteur maximale */
    overflow-y: auto; /* Défilement vertical */

}

th, td {
    border: 1px solid black;
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
    margin-top: 20px; /* Espacement en haut */
    margin-right: 20px; /* Espacement à droite */
    max-height: 200px; /* Hauteur maximale ajustée */
    overflow-y: auto; /* Ajout de défilement vertical */
    border: 1px solid #ccc; /* Bordure */
    border-radius: 5px; /* Coins arrondis */
    background-color: #fff; /* Couleur de fond */
}

.menu h2 {
    text-align: center; /* Centrer le titre "Succursales" */
    padding: 10px 0; /* Ajouter de l'espace autour du titre */
}

.menu ul {
    list-style-type: none;
    padding: 0;
    text-align: center; /* Centrer le texte */

}

.menu ul li {
    padding: 10px; /* Espacement intérieur ajusté */
}

.menu ul li a {
    text-decoration: none;
    color: #007bff; /* Couleur de texte initiale */
    display: inline-block; /* Affichage en bloc pour appliquer les marges */
    padding: 8px 16px; /* Ajouter un espacement autour du texte */
    border: 1px solid #007bff; /* Ajouter une bordure */
    border-radius: 5px; /* Coins arrondis */
    transition: background-color 0.3s, color 0.3s; /* Transition fluide */
}

.menu ul li a:hover {
    background-color: #007bff; /* Couleur de fond au survol */
    color: #fff; /* Couleur de texte au survol */
}


#dateForm {
    margin-top: 20px;
}

button {
    padding: 10px 20px;
    background-color: #007bff; /* Bleu */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin-top: 10px; /* Espacement en haut */
    display: inline-block;
    transition: background-color 0.3s, border-color 0.3s, color 0.3s; /* Transition fluide */
}

button:hover {
    background-color: #0056b3; /* Bleu plus foncé au survol */
}

/* Bouton de déconnexion */
form[action="{{ route('logout') }}"] button {
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

form[action="{{ route('logout') }}"] button:hover {
    background-color: #c82333; /* Rouge plus foncé au survol */
    border-color: #c82333; /* Bordure rouge plus foncée au survol */
}

/* Styles pour limiter la hauteur des tableaux et activer le défilement vertical */
#releves-table,
#releves-effectues-table {
    max-height: 400px; /* Hauteur maximale */
    overflow-y: auto; /* Défilement vertical */
}


        </style>
    </head>
    <body>
        <h1>BackOffice</h1>

    
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
    </div>


 


    <h2>Relevés des températures</h2>

    <!-- Tableau des relevés -->
    <table id="releves-table">
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
                    <td>{{ date('d-m-Y', strtotime($releve->id_datetime)) }}</td> <!-- Formatage de la date sans l'heure -->
                    <td>{{ $releve->id_moment }}</td>
                    <td class="{{ $releve->tmp_ok ? 'yes' : 'no' }}">{{ $releve->releve_temp }}</td>
                    <td class="{{ $releve->hum_ok ? 'yes' : 'no' }}">{{ $releve->releve_hum }}</td>
                    <td>{{ $releve->releve_comment }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>


    <!-- Formulaire de sélection de date -->
<form id="dateForm" method="GET" action="{{ route('admin.index') }}">
    @csrf
    <label for="date">Choisir une date :</label>
    <input type="date" id="date" name="date" value="{{ isset($date) ? $date : '' }}" required>
    <button type="submit">Choisir date</button>
</form>
<h2>Relevés effectués</h2>

@if(isset($date))
    <!-- Tableau des relevés effectués -->
    <table id="releves-effectues-table">
        <!-- Insérez ici le contenu du tableau des relevés avec utilisation de $date -->
        <thead>
            <tr>
                <th>Pays</th>
                <th>Numéro de succursale</th>
                <th>Nom de la succursale</th>
                <th>Date</th>
                <th>Nom du local</th>
                <th>Matin</th>
                <th>Après-midi</th>
                <th>Soir</th>
            </tr>
        </thead>
        <tbody>
            <!-- Insérez ici les lignes du tableau des relevés avec utilisation de $date -->
            @if($releves->isEmpty())
                <tr>
                    <td colspan="8">Pas de relevés</td>
                </tr>
            @else
                @foreach($releves as $releve)
                <tr>
                    <td>{{ $releve->succursale->Pays }}</td>
                    <td>{{ $releve->succursale->id }}</td>
                    <td>{{ $releve->succursale->Nom }}</td>
                    <td>{{ date('d-m-Y', strtotime($releve->id_datetime)) }}</td> <!-- Formatage de la date sans l'heure -->
                    <td>{{ $releve->local->description }}</td>
                    <td class="{{ $releve->local->checkReleve($date, 'Matin') ? 'yes' : 'no' }}">{{ $releve->local->checkReleve($date, 'Matin') ? 'Oui' : 'Non' }}</td>
                    <td class="{{ $releve->local->checkReleve($date, 'Après-midi') ? 'yes' : 'no' }}">{{ $releve->local->checkReleve($date, 'Après-midi') ? 'Oui' : 'Non' }}</td>
                    <td class="{{ $releve->local->checkReleve($date, 'Soir') ? 'yes' : 'no' }}">{{ $releve->local->checkReleve($date, 'Soir') ? 'Oui' : 'Non' }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@else
    <p>Date non définie.</p>
@endif











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
