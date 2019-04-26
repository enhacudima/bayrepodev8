<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloEditarEstado extends Model
{
    protected $table = 'edicaodeestado';

    protected $fillable = [
        'id', 'novoestado', 'comentarios', 'idsolicitacao','idusuario','datafinalizacao','ticket_level',
    ];
}
