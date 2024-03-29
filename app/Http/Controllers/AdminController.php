<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Releve;
use App\Models\Succursale;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
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
    
            // Passer les données à la vue admin
            return view('admin.admin', compact('releves', 'locaux'));
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
    
    
    

  
    
    

}
