<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'payroll';

    protected $fillable = ['id','agentName','donsultantId','totalComission','awards','dataCorrection','accomAllowanceMobilizat','totaRendimento','irps','Outrasdeducoes','totalDasDeducoes','liquidoComissoes','nibAgentWithout','branch','period','liquidoTotalComission','liquidoAwords','liquidoMobilizacao','liquidoDataCorrections','totalliquido',
       
    ];
}
