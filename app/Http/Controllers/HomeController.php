<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index()
    {
        // Exécuter la requête SQL brute pour récupérer les 100 premières lignes
        $results = DB::connection('succursales')
        ->select("SELECT releves.id, succursales.nom as id_succ, type_local.desc as id_local, releves.id_datetime, releves.id_moment, releves.releve_temp, releves.releve_hum, releves.releve_comment
                   FROM releves
                   INNER JOIN type_local ON releves.id_local = type_local.id
                   INNER JOIN succursales ON releves.id_succ = succursales.id
                   WHERE releves.id_datetime > '2012-06-02'  -- Remplacer '2019-01-01' par la date à partir de laquelle vous souhaitez récupérer les données
                   ORDER BY releves.id_datetime DESC
                   ");
    
    
        // Convertir les résultats en une collections
        $collection = collect($results);
    
        // Paginer les résultats manuellement
        $currentPage = Paginator::resolveCurrentPage();
        $perPage = 10000;
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $releves = new Paginator($currentPageItems, count($collection), $perPage);
    
        // Retourner la vue "home" en passant les données récupérées
        return view('home', compact('releves'));
    }
    
}
