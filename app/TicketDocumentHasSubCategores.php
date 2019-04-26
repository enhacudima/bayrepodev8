<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketDocumentHasSubCategores extends Model
{
    protected $table = 'ticket_document_has_subcategores';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=false;
}
