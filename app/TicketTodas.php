<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketTodas extends Model
{
    protected $table = 'ticke_todas';

    protected $fillable = [
        'id', 'loanid', 'ClientFirstNames', 'description','LoanAmount','ClientSurname','productimg','LoanTerm','status','userid',
        'tipodecliente','nuit','nome','entidade','documentodeidentificacao','numerododocumento','emitidoem','provinciade',
        'datadeemissao','nomedobanco','nib','titulardaconta','province','agencia','assunto', 'prioridade','telefone1','telefone2','email','datadenascimento','recorentencia','status','ticket_level','city','branch','categoria','subcategoria','m_comunicacao','data_fecho',
    ];
}
