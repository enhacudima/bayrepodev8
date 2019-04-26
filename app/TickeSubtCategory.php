<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TickeSubtCategory extends Model
{
    protected $table = 'ticket_subcategory';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
