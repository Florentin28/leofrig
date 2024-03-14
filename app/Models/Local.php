<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    // Définit le nom de la table dans la base de données
    protected $table = 'locaux';

    // Définit les colonnes pouvant être massivement attribuées
    protected $fillable = [
        'id_succ', 'id_typelocal', 'description', 'sw_actif'
    ];

    // Définit la connexion à utiliser (si différente de la connexion par défaut)
    protected $connection = 'succursales';

    // Définition des relations avec d'autres tables
    public function succursale()
    {
        return $this->belongsTo(Succursale::class, 'id_succ', 'id');
    }

    public function typeLocal()
    {
        return $this->belongsTo(TypeLocal::class, 'id_typelocal', 'id');
    }
}
