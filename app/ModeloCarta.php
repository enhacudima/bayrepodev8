<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloCarta extends Model
{
    protected $table = 'cartas_reclamacao';

    protected $fillable = [
        'id','comentarios', 'idsolicitacaocarta','idusuario',
    ];
}
