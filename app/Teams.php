<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'ticket_teams';

    protected $fillable = [
        'name', 'description','idusuario',
    ];
}
