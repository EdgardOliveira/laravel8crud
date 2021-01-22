<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $table = 'visitantes';

    protected $fillable = [
        'navegador',
        'ip',
        'pais',
        'uf',
        'localidade',
        'bairro',
        'latitude',
        'longitude',
        'visita_id'
    ];
}
