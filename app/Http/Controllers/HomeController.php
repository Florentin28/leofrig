<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Releve;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les données de relevé paginées à partir du modèle Releve avec 10 éléments par page
        $releves = Releve::orderBy('id_datetime', 'desc')->paginate(10);

        // Retourner la vue "home" en passant les données récupérées
        return view('home', compact('releves'));    
    }
}