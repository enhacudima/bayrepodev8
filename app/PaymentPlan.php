<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    //
    protected $table = 'client_details';

    public $primaryKey = 'id';

    public $timestamps=true;
}