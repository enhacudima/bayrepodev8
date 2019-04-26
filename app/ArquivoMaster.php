<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArquivoMaster extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'arquivomaster';

    protected $fillable = [
      'id','loanid',	'nform',	'apoliceseguro',	'nuit',	'bi',	'lficheiro','fsalario',	'arquivo',	'tprovimento',	'status',	'observacao',	'npaginas',	'idusuario',	'extrato',	'nib',	'dsalario',	'outros','updated_at','	created_at',
    ];
}
