<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Releve;
use App\Models\User; // Importez le modèle User
use App\Models\Local;
use App\Models\TypeLocal;

class ReleveController extends Controller
{

    public function index()
    {
        // Récupérer les données de relevé paginées à partir du modèle Releve avec 10 éléments par page
        $releves = Releve::orderBy('id_datetime', 'desc')->paginate(10);

        // Retourner la vue "home" en passant les données récupérées
        return view('home', compact('releves'));    
    }


    public function create()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();
    
        // Vérifier si l'utilisateur est connecté et s'il a une succursale associée
        if ($user && $user->succursale) {
            // Récupérer les locaux associés à la succursale de l'utilisateur connecté
            $locaux = $user->succursale->locaux;
    
            // Récupérer tous les relevés triés par date pour affichage dans la vue
            $releves = Releve::orderBy('id_datetime', 'desc')->get();
    
            // Retourner la vue du formulaire d'ajout de relevé en passant les données récupérées
            return view('releves.create', compact('user', 'locaux', 'releves'));
        } else {
            // Rediriger vers une autre page ou afficher un message d'erreur si l'utilisateur n'est pas connecté ou n'a pas de succursale associée
            return redirect()->back()->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }
    }
    

    
public function store(Request $request)
{
    // Valider les données soumises par le formulaire
    $request->validate([
        'id_local' => 'required',
        'id_datetime' => 'required',
        'id_moment' => 'required',
        'releve_temp' => 'required|numeric', // Assurez-vous que la température est un nombre
        'releve_hum' => 'required|numeric', // Assurez-vous que l'humidité est un nombre
        'releve_comment' => 'nullable|max:250', // Limiter le commentaire à 250 caractères
    ]);

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Créer un nouvel objet Releve avec les données soumises
    $releve = new Releve();
    $releve->id_local = $request->id_local;
    $releve->id_datetime = $request->id_datetime;
    $releve->id_moment = $request->id_moment;
    $releve->releve_temp = $request->releve_temp;
    $releve->releve_hum = $request->releve_hum;
    $releve->releve_comment = $request->releve_comment;
    
    // Assurez-vous que l'utilisateur connecté possède une succursale avec un id_succ défini
    if ($user && $user->succursale) {
        $releve->id_succ = $user->succursale->id;
    }

    // Charger le type de local associé au local sélectionné
    $local = Local::findOrFail($request->id_local);
    $typeLocal = $local->typeLocal;

    // Vérifier si le type de local existe et que la température du relevé est dans les limites
    if ($typeLocal && $releve->releve_temp >= $typeLocal->T_min && $releve->releve_temp <= $typeLocal->T_max) {
        $releve->tmp_ok = 1; // La température est valide
    } else {
        $releve->tmp_ok = 0; // La température n'est pas valide
    }

  // Vérifier si l'humidité est dans les limites
  if ($typeLocal && $releve->releve_hum >= $typeLocal->H_min && $releve->releve_hum <= $typeLocal->H_max) {
    $releve->hum_ok = 1; // L'humidité est valide
} else {
    $releve->hum_ok = 0; // L'humidité n'est pas valide
}

    // Enregistrer le relevé
    $releve->save();

    // Rediriger l'utilisateur vers la page d'accueil avec un message de succès
    return redirect()->route('home')->with('success', 'Le relevé a été ajouté avec succès.');
}



}
