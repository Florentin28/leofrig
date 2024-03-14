<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Succursale extends Model
{
    // Définit le nom de la table dans la base de données
    protected $table = 'succursales';

    // Définit les colonnes pouvant être massivement attribuées
    protected $fillable = [
        'Nom', 'Pays', 'email', 'langue', 'motpasse', 'sw_actif'
    ];

    // Définit la connexion à utiliser (si différente de la connexion par défaut)
    protected $connection = 'succursales';

    public function locaux()
{
    return $this->hasMany(Local::class, 'id_succ');
}


    // Autres attributs et méthodes du modèle...
}
