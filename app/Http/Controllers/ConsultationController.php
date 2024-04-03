<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Releve;
use App\Models\Succursale;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Récupérer l'ID de la succursale sélectionnée depuis la requête
            $local_id = $request->query('local_id');
            
            // Vérifier si un ID de succursale est spécifié dans la requête
            if ($local_id) {
                // Récupérer tous les relevés filtrés par l'ID de la succursale
                $releves = Releve::where('id_local', $local_id)->get();
            } else {
                // Si aucun ID de succursale n'est spécifié, récupérer tous les relevés
                $releves = Releve::all();
            }
    
            // Récupérer tous les locaux distincts
            $locaux = Succursale::distinct()->get(['id', 'Nom']);
    
            // Passer les données à la vue consultation
            return view('consultation', compact('releves', 'locaux'));
        } catch (\Exception $e) {
            // Gérer les erreurs
            return view('consultation')->with('error', 'Une erreur est survenue lors de la récupération des données.');
        }
    }
    

    public function show(Succursale $succursale)
    {
        try {
            // Récupérer les relevés pour la succursale spécifique
            $releves = $succursale->releves;
    
            // Retourner la vue avec les relevés
            return view('consultation', compact('succursale', 'releves'));
        } catch (\Exception $e) {
            // Gérer les erreurs
            return view('consultation')->with('error', 'Une erreur est survenue lors de la récupération des données.');
        }
    }
}

