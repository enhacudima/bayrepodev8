<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eft extends Model
{
    protected $table = 'eft';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
