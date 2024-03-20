<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function index()
    {
        // Récupérer la date actuelle
        $date = Carbon::now()->format('Y-m-d');

        // Récupérer les locaux de la succursale
        $locaux = Local::where('id_succ', auth()->user()->id_succ)->get();

        return view('verification.index', compact('date', 'locaux'));
    }
}
