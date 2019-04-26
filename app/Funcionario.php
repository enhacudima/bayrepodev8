<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'funcionariosviews';

    protected $guarded =array();

    public $primaryKey = 'id';

}
