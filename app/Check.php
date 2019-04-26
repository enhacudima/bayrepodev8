<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $table = 'checks';

    public $primaryKey = 'id';

    public $timestamps=true;
}
