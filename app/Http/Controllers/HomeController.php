<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Releve;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer le filtre de la requête GET
        $filter = $request->query('filter');

        // Filtrer les données en fonction du filtre
        if ($filter === 'aujourd_hui') {
            $releves = Releve::whereDate('id_datetime', now())->orderBy('id_datetime', 'desc')->paginate(10);
        } else {
            $releves = Releve::orderBy('id_datetime', 'desc')->paginate(10);
        }

        // Retourner la vue avec les données filtrées
        return view('home', compact('releves'));    
    }
}
