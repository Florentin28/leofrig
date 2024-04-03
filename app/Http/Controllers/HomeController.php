<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Releve;

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
    
}
