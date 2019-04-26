<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'agencia';

    protected $fillable = [
        'outletSyncNameCorrected', 'outletSyncName', 
    ];
}
