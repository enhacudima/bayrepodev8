<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    protected $table = 'black_lists';

    public $primaryKey = 'id';

    public $timestamps=true;
}
