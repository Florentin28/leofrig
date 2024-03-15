<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Releve extends Model
{
    // Définit le nom de la table dans la base de données
    protected $table = 'releves';

    // Définit les colonnes pouvant être massivement attribuées
    protected $fillable = ['id_succ', 'id_local', 'id_datetime', 'id_moment', 'releve_temp', 'tmp_ok', 'releve_hum', 'hum_ok', 'releve_comment'];

    // Définit la connexion à utiliser (si différente de la connexion par défaut)
    protected $connection = 'succursales';

    // Définition de la relation avec le modèle Succursale
    public function succursale()
    {
        return $this->belongsTo(Succursale::class, 'id_succ', 'id');
    }
    
    // Définition de la relation avec le modèle Local
    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local', 'id');
    }
}
