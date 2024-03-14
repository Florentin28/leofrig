<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeLocal extends Model
{
    // Définit le nom de la table dans la base de données
    protected $table = 'type_local';

    // Définit les colonnes pouvant être massivement attribuées
    protected $fillable = [
        'desc', 'T_min', 'T_max', 'sw_hum', 'H_min', 'H_max'
    ];

    // Définit la connexion à utiliser (si différente de la connexion par défaut)
    protected $connection = 'succursales';

    // Autres attributs et méthodes du modèle...
}
