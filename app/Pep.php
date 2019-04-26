<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pep extends Model
{
    protected $table = 'peps';

    public $primaryKey = 'id';

    public $timestamps=true;
}
