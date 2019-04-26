<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclamacoes extends Model
{
    protected $table = 'reclamacoes';

    protected $fillable = [
        'id', 'loanid', 'ClientFirstNames', 'description','LoanAmount','ClientSurname','productimg','LoanTerm','status','userid',
        'tipodecliente','nuit','nome','entidade','documentodeidentificacao','numerododocumento','emitidoem','provinciade',
        'datadeemissao','nomedobanco','nib','titulardaconta',
    ];
}
