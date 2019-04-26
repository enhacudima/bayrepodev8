<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leveluser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'leveluser';

    protected $fillable = [
        'id', 'discricao', 'fk_user_id','detalhes',
    ];
}
