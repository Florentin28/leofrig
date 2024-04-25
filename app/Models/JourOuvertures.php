<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JourOuverture extends Model
{
    protected $table = 'jour_ouvertures';

    protected $fillable = [
        'id_succ', 'ouv_1', 'ouv_2', 'ouv_3', 'ouv_4', 'ouv_5', 'ouv_6', 'ouv_7',
    ];

    // Si vous n'utilisez pas de timestamps (created_at, updated_at)
    public $timestamps = false;
}
