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

    .btn {
        margin-top: 20px;
        padding: 12px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn:hover {
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
        background-color: green;
    }

    /* Styles pour la boîte modale */
    .modal {
        display: none; /* Masque la boîte modale par défaut */
        position: fixed;
        z-index: 1;
        left: 0;   
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* Fond semi-transparent pour obscurcir le reste de la page */
        justify-content: center;
        align-items: center;
        z-index: 1001; /* Assurez-vous que le modal a un z-index plus grand que celui du bouton Accueil */
        

    }

    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border-radius: 5px;
    }

    .button-container {
        text-align: center;
    }

    button {
        margin: 0 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .btn-home {
    position: fixed;
    left: 20px;
    top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    z-index: 1000; /* Assurez-vous que le bouton reste au-dessus de tout le contenu */
}

.btn-home:hover {
    background-color: #0056b3;
}

</style>


</head>
<body>
<a href="{{ route('home') }}" class="btn-home">Accueil</a>

    <div>
        <h1>Ajouter un relevé</h1>

        <!-- Formulaire de création d'un relevé -->
        <div class="form-container">
        <form id="myForm" action="{{ route('releves.store') }}" method="POST">
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



<!-- Structure de la boîte modale -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <p>Êtes-vous sûr d'ajouter ce relevé ?</p>
    <div id="modal-info">
      <!-- Infos à confirmer -->
      <p>Date: <span id="confirmDate"></span></p>
      <p>Local: <span id="confirmLocal"></span></p>
      <p>Moment de la journée: <span id="confirmMoment"></span></p>
      <p>Température: <span id="confirmTemp"></span></p>
      <p>Taux d'humidité: <span id="confirmHum"></span></p>
      <p>Commentaire: <span id="confirmComment"></span></p>
    </div>
    <div class="button-container">
      <!-- Bouton "Non" pour fermer la boîte modale -->
      <button id="closeModal">Non</button>
      <button id="confirmYes">Oui</button>
    </div>
  </div>
</div>




                <!-- Bouton de soumission -->
                <button type="submit">Ajouter Relevé</button>
            </form>
        </div>
    </div>

    <!-- Ajoutez ce code à la vue create.blade.php -->
<a href="{{ route('verifier-releves') }}" class="btn btn-primary">Vérifier les relevés</a>


<!-- Tableau des données de la base de données -->
<div class="table-container">
    <h2>Liste des relevés</h2>
    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Nom du Succursale</th>
                <th>Description du Local</th>
                <th>Date et heure</th>
                <th>Moment de la journée</th>
                <th>Température</th>
                <th>Taux d'humidité</th>
                <th>Commentaire</th>
                <th>Actions</th>
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
                    <td>
                    <form action="{{ route('releves.destroy', $releve) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce relevé ?')">Supprimer</button>
            </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>

<script>
// Fonction pour fermer la boîte modale
function closeModal() {
  console.log("Fermeture de la boîte modale");
  document.getElementById("myModal").style.display = "none";
}

// Récupérer la valeur de la date saisie dans le formulaire
const date = document.getElementById("id_datetime").value;
// Afficher la date dans le modal
document.getElementById("confirmDate").textContent = "Date : " + date;

// Fonction pour afficher la boîte modale avec les informations du relevé
function displayModal() {
  // Récupérer les valeurs saisies dans le formulaire
  const date = document.getElementById("id_datetime").value;
  const local = document.getElementById("id_local").value;
  const moment = document.querySelector('input[name="id_moment"]:checked').value;
  const temperature = document.getElementById("releve_temp").value;
  const humidite = document.getElementById("releve_hum").value;
  const commentaire = document.getElementById("releve_comment").value;
  // Formater la date au format jour/mois/année
  const formattedDate = new Date(date).toLocaleDateString('fr-FR');
  // Afficher les informations dans la boîte modale
  document.getElementById("confirmDate").textContent = formattedDate;
  document.getElementById("confirmLocal").textContent = local;
  document.getElementById("confirmMoment").textContent = moment;
  document.getElementById("confirmTemp").textContent = temperature;
  document.getElementById("confirmHum").textContent = humidite;
  document.getElementById("confirmComment").textContent = commentaire;
  // Afficher la boîte modale
  document.getElementById("myModal").style.display = "block";
}

// Afficher la boîte modale lorsque le bouton "Ajouter Relevé" est cliqué
document.getElementById("myForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêcher la soumission du formulaire par défaut
  console.log("Affichage de la boîte modale");
  displayModal();
});

// Ajouter un écouteur d'événement pour le clic sur le bouton "Non"
document.getElementById("closeModal").addEventListener("click", function(event) {
  console.log("Bouton 'Non' cliqué");
  closeModal(); // Appeler la fonction pour fermer la boîte modale
  event.preventDefault(); // Empêcher la soumission du formulaire
});

// Ajouter un écouteur d'événement pour le clic sur le bouton "Oui"
document.getElementById("confirmYes").addEventListener("click", function() {
  console.log("Bouton 'Oui' cliqué");
  closeModal(); // Appeler la fonction pour fermer la boîte modale
  document.getElementById("myForm").submit();
});
</script>
