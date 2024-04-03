<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use Carbon\Carbon;
use App\Models\Releve;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer la date sélectionnée par l'utilisateur depuis la requête HTTP
        $selectedDate = $request->input('date');

        // Définir une date par défaut si aucune date n'est sélectionnée
        $date = $selectedDate ?? Carbon::now()->format('Y-m-d');
        
        // Utiliser la date pour filtrer les relevés dans la base de données
        $releves = Releve::whereDate('id_datetime', $date)->get();
        
        // Récupérer les locaux de la succursale
        $locaux = Local::where('id_succ', auth()->user()->id_succ)->get();

        // Retourner la vue avec les données nécessaires
        return view('verification.index', compact('releves', 'locaux', 'date'));
    }
}
