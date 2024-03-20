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

    // Définition de la relation avec les relevés
    public function releves()
    {
        return $this->hasMany(Releve::class, 'id_local', 'id');
    }

    // Méthode pour vérifier si un relevé existe pour ce local à cette date et ce moment
    public function checkReleve($date, $moment)
    {
        return $this->releves()
                    ->whereDate('id_datetime', $date)
                    ->where('id_moment', $moment)
                    ->exists();
    }
}

