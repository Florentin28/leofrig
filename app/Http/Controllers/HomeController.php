<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Releve;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log; // Ajout de l'import pour utiliser Log



class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Vérifier si l'utilisateur est connecté et s'il a une succursale associée
        if ($user && $user->succursale) {
            // Récupérer le filtre de la requête GET
            $filter = $request->query('filter');
    
            // Filtrer les données en fonction du filtre et de la succursale de l'utilisateur connecté
            if ($filter === 'aujourd_hui') {
                $releves = Releve::where('id_succ', $user->succursale->id)
                                ->whereDate('id_datetime', now())
                                ->orderBy('id_datetime', 'desc')
                                ->paginate(100);
            } else {
                $releves = Releve::where('id_succ', $user->succursale->id)
                                ->orderBy('id_datetime', 'desc')
                                ->paginate(100);
            }
    
            // Retourner la vue avec les données filtrées
            return view('home', compact('releves'));
        } else {
            // Rediriger vers une autre page ou afficher un message d'erreur si l'utilisateur n'est pas connecté ou n'a pas de succursale associée
            return redirect()->back()->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }
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
