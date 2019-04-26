<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TickeDocument extends Model
{
    protected $table = 'ticket_document';
    protected $guarded =array();

    public $primaryKey = 'id';
    protected $rules = [
    'name' => 'unique:ticket_document,name',
	];

    public $timestamps=true;
}
