<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketTeamTime extends Model
{
    protected $table = 'ticket_team_time';

    protected $fillable = [
        'id','idsolicitacao','status','idusuario','ticket_level','time_level','comentarios',
    ];
}
