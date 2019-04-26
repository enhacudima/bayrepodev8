<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';

    public $primaryKey = 'id';

    public $timestamps=true;
}
