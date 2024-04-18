<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Méthode 1: Récupérer la langue à partir de l'en-tête Accept-Language de la requête HTTP
        $langFromHeader = $request->header('Accept-Language');

        // Méthode 2: Récupérer la langue à partir du paramètre de langue dans l'URL (si présent)
        $langFromUrl = $request->lang;

        // Méthode 3: Récupérer la langue à partir de la session de l'utilisateur (si présente)
        $langFromSession = $request->session()->get('locale');

        // Méthode 4: Récupérer la langue à partir du cookie de l'utilisateur (si présent)
        $langFromCookie = $request->cookie('locale');

        // Méthode 5: Récupérer la langue à partir du domaine ou du sous-domaine (si nécessaire)
        // Vous devrez implémenter cette logique en fonction de votre configuration de domaine

        // Détermination de la langue à utiliser en fonction des méthodes ci-dessus
        $lang = $langFromUrl ?? $langFromSession ?? $langFromCookie ?? $langFromHeader ?? 'fr';

        // Définition de la langue dans l'application Laravel
        App::setLocale($lang);

        // Passer la requête au prochain middleware
        return $next($request);
    }
}
