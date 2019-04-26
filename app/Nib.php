<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nib extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'nibfuncionarios';

    protected $fillable = [
        'COD_ORGANICO', 'DESC_ORGANICO', 'NIB', 'NOME','NUIT',
    ];
}
