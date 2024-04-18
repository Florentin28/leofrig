<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Releve;
use App\Models\User; // Importez le modèle User
use App\Models\Local;
use App\Models\TypeLocal;
use Illuminate\Support\Facades\Log; // Ajout de l'import pour utiliser Log
use App\Models\Succursale;



class ReleveController extends Controller
{

    public function index()
    {
 
        // Retourner la vue "home" en passant les données récupérées
        return view('home', compact('releves'));    
    }


    public function create() 
    {
        // Récupérer l'utilisateur connecté 
        $user = auth()->user();
    
        // Vérifier si l'utilisateur est connecté et s'il a une succursale associée
        if ($user && $user->succursale) {
            // Récupérer la succursale associée à l'utilisateur connecté
            $succursaleId = $user->succursale->id;
    
            // Récupérer les locaux associés à la succursale de l'utilisateur connecté
            $locaux = $user->succursale->locaux;
    
            // Récupérer les relevés associés à la succursale de l'utilisateur connecté
            $releves = Releve::where('id_succ', $succursaleId)
                        ->orderBy('id_datetime', 'desc')
                        ->get();
    
            // Retourner la vue du formulaire d'ajout de relevé en passant les données récupérées
            return view('releves.create', compact('user', 'locaux', 'releves'));
        } else {
            // Rediriger vers une autre page ou afficher un message d'erreur si l'utilisateur n'est pas connecté ou n'a pas de succursale associée
            return redirect()->back()->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }
    }
    
    
    

    public function relevesEffectues()
    {
        try {
            // Récupérer les relevés effectués depuis la base de données en chargeant la relation succursale
            $releves_effectues = Releve::with('succursale')->get();
            
            // Récupérer toutes les succursales
            $succursales = Succursale::all();
    
         
    
            // Passer les relevés effectués et les succursales à la vue
            return view('admin.releves_effectues', compact('releves_effectues', 'succursales'));
        } catch (\Exception $e) {
            // Gérer les erreurs
            return view('admin.releves_effectues')->with('error', 'Une erreur est survenue lors de la récupération des données.');
        }
    }
    
    

    

    public function emplacementsARelever()
    {
        // Récupérer les locaux à relever en incluant les données des succursales associées
        $locaux = Local::with('succursale')->get();
        
        // Retourner la vue avec les locaux récupérés
        return view('admin.emplacements_a_relever', compact('locaux'));
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
        'releve_comment' => 'nullable|max:100', // Limiter le commentaire à 250 caractères
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

public function destroy(Releve $releve)
{
    $releve->delete();
    return redirect()->back()->with('success', 'Le relevé a été supprimé avec succès.');
}


public function switchLanguage($lang)
    {
        // Définition de la langue dans la session
        session(['locale' => $lang]);

        // Ajout d'un message dans la console pour indiquer que la langue a été sélectionnée
        Log::info("Langue sélectionnée : $lang"); // Message de log

        // Redirection vers la page précédente
        return redirect()->back();
    }


}
