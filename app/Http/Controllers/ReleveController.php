<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Releve;
use App\Models\User; // Importez le modèle User

class ReleveController extends Controller
{

    public function index()
{
    // Récupérer les données de relevé paginées à partir de la base de données
    $releves = Releve::paginate(10); // Paginate avec 10 éléments par page

    // Retourner la vue en passant les données récupérées
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

        // Retourner la vue du formulaire d'ajout de relevé en passant les données récupérées
        return view('releves.create', compact('user', 'locaux'));
    } else {
        // Rediriger vers une autre page ou afficher un message d'erreur si l'utilisateur n'est pas connecté ou n'a pas de succursale associée
        return redirect()->back()->with('error', 'Veuillez vous connecter pour accéder à cette page.');
    }
}

    

    

public function store(Request $request)
{
    // Valide les données soumises par le formulaire
    $request->validate([
        'id_local' => 'required',
        'id_datetime' => 'required',
        'id_moment' => 'required',
        'releve_temp' => 'required',
        'releve_hum' => 'required',
        'releve_comment' => 'nullable',
    ]);

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Crée un nouvel objet Releve avec les données soumises
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

    // Définir une valeur pour tmp_ok (à modifier selon vos besoins)
    $releve->tmp_ok = 0; // par exemple, utilisez 0 comme valeur par défaut

    $releve->save();

    // Redirige l'utilisateur vers la page d'accueil avec un message de succès
    return redirect()->route('home')->with('success', 'Le relevé a été ajouté avec succès.');
}


}
