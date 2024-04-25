<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Releve;
use App\Models\Succursale;
use Illuminate\Support\Facades\Log;
use App\Models\Local;
use Carbon\Carbon;
use App\Models\Typelocal;




class AdminController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Récupérer l'ID de la succursale sélectionnée depuis la requête
            $local_id = $request->query('local_id');
            
            // Récupérer la date sélectionnée par l'utilisateur depuis la requête HTTP
            $selectedDate = $request->input('date');
    
            // Définir une date par défaut si aucune date n'est sélectionnée
            $date = $selectedDate ?? Carbon::now()->format('Y-m-d');
            
            // Récupérer tous les locaux distincts
            $locaux = Succursale::distinct()->get(['id', 'Nom']);
    
            // Récupérer tous les relevés pour la date sélectionnée
            $releves = Releve::whereDate('id_datetime', $date);
    
            // Si un ID de succursale est spécifié, filtrer les relevés par cet ID
            if ($local_id) {
                $releves->where('id_local', $local_id);
            }
    
            // Récupérer les relevés filtrés
            $releves = $releves->get();
            Log::info('Données du troisième tableau:', compact('releves', 'locaux', 'date'));

            // Passer les données à la vue admin avec la variable $date
            return view('admin.admin', compact('releves', 'locaux', 'date'));
        } catch (\Exception $e) {
            // Gérer les erreurs
            return view('admin.admin')->with('error', 'Une erreur est survenue lors de la récupération des données.');
        }
    }
    
    
    


    
    public function showSuccursale($id)
    {
        try {
            // Récupérer la succursale correspondante à l'ID
            $succursale = Succursale::findOrFail($id);
            
            // Récupérer tous les relevés associés à cette succursale
            $releves = Releve::where('id_succ', $id)->get();
    
            // Récupérer tous les locaux distincts (pour la liste des succursales)
            $locaux = Succursale::distinct()->get(['id', 'Nom']);
    
            // Passer les données à la vue admin
            return view('admin.admin', compact('releves', 'succursale', 'locaux'));
        } catch (\Exception $e) {
            // Gérer les erreurs
            return view('admin.admin')->with('error', 'Une erreur est survenue lors de la récupération des données.');
        }
    }
    
    

    
    
// Méthode pour afficher la page des relevés effectués
public function showRelevesEffectues()
{
    // Récupérer toutes les succursales
    $locaux = Succursale::all();

    // Supposons que vous récupériez les données des relevés depuis votre modèle Releve
    $releves = Releve::all(); // Ou vous pouvez récupérer les relevés d'une autre manière selon vos besoins

    // Passer les données des succursales et des relevés à la vue et afficher la page releves_effectues.blade.php
    return view('admin.releves_effectues', compact('locaux', 'releves'));
}



public function emplacementsARelever()
{
    // Récupérer toutes les succursales
    $locaux = Succursale::all();

    // Supposons que vous récupériez les données des relevés depuis votre modèle Releve
    $releves = Releve::all(); // Ou vous pouvez récupérer les relevés d'une autre manière selon vos besoins

    // Passer les données des succursales et des relevés à la vue et afficher la page releves_effectues.blade.php
    return view('admin.emplacements_a_relever', compact('locaux', 'releves'));
}




public function ouvertures()
{
    // Récupérer toutes les succursales
    $locaux = Succursale::all();

    // Supposons que vous récupériez les données des relevés depuis votre modèle Releve
    $releves = Releve::all(); // Ou vous pouvez récupérer les relevés d'une autre manière selon vos besoins

    // Passer les données des succursales et des relevés à la vue et afficher la page releves_effectues.blade.php
    return view('admin.ouvertures', compact('locaux', 'releves'));
}






}
