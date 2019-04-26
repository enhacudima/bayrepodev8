@extends('adminlte::page')

@section('title', 'Bayport | This Ticket')

@section('content_header')
    <h1>This Ticket</h1>
@stop


@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<div class="container">

<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li role="presentation" class="active">
                <a href="">Este Ticket
         
                </a>
            </li>
            <li role="presentation" class="">
                <a href="{{ url('myticket') }}">Tickets Activos
                    <span class="badge">
                         {{$acteticket}}                    </span>
                </a>
            </li>
            <li role="presentation" class="">
                <a href="{{ url('completticket') }}">Tickets Fechados
                    <span class="badge">
                        {{$completticket}}                   </span>
                </a>
            </li>


              
        </ul>
            <div class="row bs-wizard" style="border-bottom:0;">
                @if($teamon=='0')
                        <div class="col-xs-3 bs-wizard-step complete">
                          <div class="text-center bs-wizard-stepnum">Etapa 1</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Criação & Submição</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- complete complete -->
                          <div class="text-center bs-wizard-stepnum">Etapa 2</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Em analise</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step active"><!-- complete active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 3</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Outras equipas</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 4</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Fechado</div>
                        </div>
                @elseif($ticket->status == 0)
                        <div class="col-xs-3 bs-wizard-step complete">
                          <div class="text-center bs-wizard-stepnum">Etapa 1</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Criação & Submição</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- complete complete -->
                          <div class="text-center bs-wizard-stepnum">Etapa 2</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Analise</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- complete active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 3</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Outras equipas</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 4</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Fechado FPoC</div>
                        </div>
                @elseif($ticket->status == 2)
                        <div class="col-xs-3 bs-wizard-step complete">
                          <div class="text-center bs-wizard-stepnum">Etapa 1</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Criação & Submição</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- complete complete -->
                          <div class="text-center bs-wizard-stepnum">Etapa 2</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Analise</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- complete active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 3</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Outras equipas</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step complete"><!-- active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 4</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Fechado </div>
                        </div>
                @elseif($ticket->status == 1)
                        <div class="col-xs-3 bs-wizard-step complete">
                          <div class="text-center bs-wizard-stepnum">Etapa 1</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Criação & Submição</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step active"><!-- complete complete -->
                          <div class="text-center bs-wizard-stepnum">Etapa 2</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Em analise</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 3</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Outras equipas</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 4</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Fechado</div>
                        </div>
                @elseif($ticket->status == 3)
                        <div class="col-xs-3 bs-wizard-step complete">
                          <div class="text-center bs-wizard-stepnum">Etapa 1</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Criação & Submição</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step active"><!-- complete complete -->
                          <div class="text-center bs-wizard-stepnum">Etapa 2</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Reenviado para Origem</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 3</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Outras equipas</div>
                        </div>
                        
                        <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                          <div class="text-center bs-wizard-stepnum">Etapa 4</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                          <div class="bs-wizard-info text-center">Fechado</div>
                        </div>
                @endif
                
                
            </div>
    </div>
</div>

    <div class="">
    <!-- Mensagens-->
    @include('messages')
    <!-- /Mensagens-->
    </div>

        <div class="panel panel-default">
    <div class="panel-body">
        <div class="content">
            <h2 class="header">
                #{{$ticket->id}}: {{$ticket->assunto}} 

                <span class="pull-right">
                        @if(Auth::user()->ticket_level=="2"|Auth::user()->branch==$ticket->branch || Auth::user()->ticket_level=="1"||Auth::user()->ticket_level==$ticket->ticket_level||Auth::user()->id==$ticket->userid)
                        @can('myticket-completticket')
                        @if($ticket->status=="1")
                        <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#ticket-close-non-modal">Close Ticket</button>
                        @else
                        <a href="" class="btn btn-success reopenticket" form="reopen-ticket" node="{{$ticket->assunto}}">Reabrir</a>
                        @endif
                        @endcan
                        
                       
                        @if($ticket->status=="1")
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-file-modal">Edit Fill</button>
                            @if($ticket->tipodecliente=="Cliente")
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-modal">Edit</button>
                            @else
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-non-modal">Edit</button>
                            @endif

                            @if( Auth::user()->ticket_level=="1")
                            <a href="" class="btn btn-danger sendtoorgin" form="send-to-orgin" node="{{$ticket->assunto}}">Resend to Origin</a>
                            @endif
                        @else
                    
                             <button type="button" class="btn btn-info" disabled="disabled">Edit</button>
                             @if( Auth::user()->ticket_level=="1")
                             <button type="button" class="btn btn-danger" disabled="disabled">Resend to Origin</button>
                             @endif
                        @endif
                        @endif
                        <a href="" class="btn btn-danger deleteit" form="delete-ticket-1" node="{{$ticket->assunto}}">Delete</a>
                    </form>
                </span>
            </h2>
            <div class="panel well well-sm" style="margin-top: 50px">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p> <strong>Criado por</strong>: {{$ticket->name}} {{$ticket->lname}}</p>
                            <p> <strong>Agencia</strong>: {{$ticket->outletSyncNameCorrected}}</p>
                            <p>
                                <strong>Status</strong>:
                                @if($ticket->status=="0")
                                <span style="color: #25b347">
                                    FPoC
                                </span>
                                @else

                                @if($ticket->status=="2")
                                <span style="color: #25b347">
                                    Completed
                                </span>

                                
                                @else

                                @if($ticket->status=="1")
                                <span style="color: #ef1908">
                                    Active
                                </span>
                                @else

                                @if($ticket->status=="3")
                                <span style="color: #ef1908">
                                    Resended to Orgin
                                </span>

                                @endif
                                @endif
                                @endif
                                @endif
                                
                            </p>
                            <p>
                                <strong>Prioridade</strong>: 
                                @if($ticket->prioridade=="Alta")
                                <span style="color: #e10000">
                                    {{$ticket->prioridade}}
                                </span>
                                @else

                                @if($ticket->prioridade=="Normal")
                                <span style="color: #EC971F">
                                    {{$ticket->prioridade}}
                                </span>

                                
                                @else

                                @if($ticket->prioridade=="Baixa")
                                <span style="color: #31B0D5">
                                    {{$ticket->prioridade}}
                                </span>

                                @endif
                                @endif
                                @endif
                            </p>
                            <p> <strong>Meio de Comunicação</strong>: {{$ticket->m_comunicacao}}</p>
                            <p> <strong>Recorência</strong>: {{$ticket->recorentencia}}</p>

                            <p> <strong>Expira em</strong>: <span style="color: #ef1908">{{$ticket->created_at->addDays($ticket->time)->diffForHumans()}}</span></p>
                        </div>
                        <div class="col-md-6">
                            @if(Auth::user()->ticket_level=='1')
                           
                            <p> <strong>Responsabilidade</strong>:  @if($ticket->status=="1")<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ticket-title-non-modal">+</button>@endif <button type="button" class="btn btn-info btn-xs col-sm-offset" data-toggle="modal" data-target="#ticket-teams-non-modal">lista</button></p>
                            
                            @else
                            <p> <strong>Responsabilidade</strong>: <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ticket-teams-non-modal">lista</button></p>
                            @endif
                            <p>    
                                <strong>Categoria</strong>: 
                                <span style="color: #7e0099">
                                    {{$ticket->tiposolicitacao}}
                                </span>
                            </p>
                            <p>    
                                <strong>Sub-Categoria</strong>: 
                                <span style="color: #31B0D5">
                                    {{$ticket->subcategory}}
                                </span>
                            </p>
                            <p> <strong>Data de Criação</strong>: {{$ticket->created_at}}</p>
                            <p> <strong>Criado</strong>: {{$ticket->created_at->diffForHumans()}}</p>
                            <p> <strong>Ultima Atualização</strong>: {{$ticket->updated_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel well well-sm">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p><strong>Tipo de Cliente</strong>: {{$ticket->tipodecliente}}</p>
                            <p><strong>Cliente</strong>: {{$ticket->ClientFirstNames}}</p>
                            <p><strong>Apelido</strong>: {{$ticket->ClientSurname}}</p>
                            <p><strong>Loan ID</strong>: {{$ticket->loanid}}</p>
                            <p><strong>Email</strong>: {{$ticket->email}}</p>
                            <p><strong>Data de Nascimento</strong>: {{$ticket->datadenascimento}}</p>
                            <p><strong>Documento</strong>: {{$ticket->documentodeidentificacao}}</p>
                            <p><strong>Número do Documento</strong>: {{$ticket->numerododocumento}}</p>
                            <p><strong>Emetido em</strong>: {{$ticket->emitidoem}}</p>
                            <p><strong>Data de emissão</strong>: {{$ticket->datadeemissao}}</p>
                            <p><strong>Email</strong>: {{$ticket->email}}</p>
                            <p><strong>Telefone-1</strong>: {{$ticket->telefone1}}</p>
                            <p><strong>Telefone-2</strong>: {{$ticket->telefone2}}</p>
                        </div>
                        <div class="col-md-6">
                            <p> <strong>NUIT</strong>: {{$ticket->nuit}}</p>
                            <p> <strong>NIB</strong>: {{$ticket->nib}}</p>
                            <p> <strong>Banco</strong>: {{$ticket->nomedobanco}}</p>
                            <p> <strong>Titular da Conta</strong>: {{$ticket->titulardaconta}}</p>
                            <p><strong>Periodo do Loan</strong>: {{$ticket->LoanTerm}}</p>
                            <p> <strong>Criado</strong>: {{$ticket->created_at->diffForHumans()}}</p>
                            <p> <strong>Ultima Atualização</strong>: {{$ticket->updated_at->diffForHumans()}}</p>
                            @if(isset($anexos))
                            @foreach($anexos as $key => $cil)
                            <p> <strong>Anexo-{{$key}}</strong>: <a class="fa fa-file " aria-hidden="true" href="{{asset('storage/productimg/'.$cil->filename)}}" target="_self"> {{$cil->file_name}}</a></p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 fot textjusty ">
                {!!$ticket->description!!}

            </div>
        </div>



        <form method="POST" action="{{url('/sendtoorgin')}}" accept-charset="UTF-8" id="send-to-orgin">
             {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="3">
        </form>

        <form method="POST" action="{{url('reopenticket', $ticket->id)}}" accept-charset="UTF-8" id="reopen-ticket">
             {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
        </form>
    </div>
</div>



<!--modal close ticket form-->
<div class="modal fade" id="ticket-close-non-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-close-non-modal-Label">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('/closeticket')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">

            <div class="modal-header">
                <h4 class="modal-title" id="ticket-close-non-modal-Label">Comentario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">

                <div class="col-sm-12">
                    <div class="row"></div>
                    <div class="form-group">
                        <textarea class="form-control textarea" rows="5" required="required" name="comentarios" cols="50">

                            {{{ $ticket->comentarios or old('comentarios') }}}

                        </textarea>
                        <small id="fileHelp" class="form-text text-muted" ><a style="color: red">*</a> Nota: Por favor descreva o motivo do fecho deste ticket de uma forma clara e objectiva</small>
                    </div>
                </div>

            </div>
                  

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
</div>


<!--modal teams-->
<div class="modal fade" id="ticket-teams-non-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-teams-non-modal-Label">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('/addteamticket')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">

            <div class="modal-header">
                <h4 class="modal-title" id="ticket-teams-non-modal-Label"><strong>Team Status</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">

                <div class="col-sm-12">
                    <div class="row"></div>
                    <div class="form-group">
                        <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-hover dataTable" cellspacing="0" width="100%" style="font-size:9">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Criado em</th>
                                <th>Atualizado em</th>
                                <th>Team</th>
                                <th>Tempo (dias)</th>
                                <th>Espira_em</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                                @foreach($teamstatus as $key=>$cil)
                                <tr>
                                <td>{{$key}}</td>
                                <td>{{$cil->created_at}}</td>
                                <td>{{$cil->updated_at}}</td>
                                <td>{{$cil->teamstatus_level}}</td>
                                <td>{{$cil->time_level}}</td>
                                <td>{{$cil->created_at->addDays($cil->time_level)->diffForHumans()}}</td>
                                <td> @if($cil->status==0)
                                        <a class="" ><i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true"></i></a>
                                     @else
                                        <a class="" ><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i></a>
                                        <p>{!!$cil->comentarios!!}</p>   
                                     @endif   

                                </td>
                                <td><div class="row">
                                    @if($ticket->status=="1")
                                    @if(Auth::user()->ticket_level=="1")
                                    <a class="" href="{{action('TicketController@deleteteamlistlevel', [$cil->id,$ticket->id])}}"><i class="btn btn-danger fa fa-trash-o fa-1x" aria-hidden="true"></i></a>
                                    @endif
                                    @if($cil->status==0)
                                    @if(Auth::user()->ticket_level==$cil->ticket_level)
                                    <a class="" ><i class="btn btn-warning fa fa-check-square-o fa-1x" aria-hidden="true"  data-toggle="modal" data-target="#ticket-complet-non-modal"></i></a></div></td>
                                    @endif
                                    @endif
                                    @endif
                                </tr>
                                @endforeach
                           
                        </tbody>

                    </table>
                    </div>
                </div>
                </div>

            </div>
                  

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
            </form>
                </div>
            </div>
</div>


<!--modal complet ticket form-->
<div class="modal fade" id="ticket-complet-non-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-complet-non-modal-Label">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('/completeteamtask')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">

            <div class="modal-header">
                <h4 class="modal-title" id="ticket-complet-non-modal-Label">Comentario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">

                <div class="col-sm-12">
                    <div class="row"></div>
                    <div class="form-group">
                        <textarea class="form-control textarea" rows="5" required="required" name="comentarios" cols="50">

                            {{{ $ticket->comentarios or old('comentarios') }}}

                        </textarea>
                        <small id="fileHelp" class="form-text text-muted" ><a style="color: red">*</a> Nota: Por favor descreva o motivo do fecho desta actividade de uma forma clara e objectiva</small>
                    </div>
                </div>

            </div>
                  

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
</div>


<!--modal level-->
<div class="modal fade" id="ticket-title-non-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-title-non-modal-Label">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('/addteamticket')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">

            <div class="modal-header">
                <h4 class="modal-title" id="ticket-title-non-modal-Label">{{$ticket->ticket_level}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="row"></div>
                    <div class="form-group">
                        <div class="addteam" id="addteam" name="addteam">
                            <select class="form-control col-md-8" value="{{{ isset($ticket_level->ticket_level) or old('ticket_level') }}}"  id="ticket_level"  name="ticket_level" required autofocus style="height: auto">
                                <option disabled value selected>Select..</option>
                                 @foreach($teams as $cils)
                                <option value="{{$cils->id}}">
                                    {{$cils->name}}
                                </option>
                                 @endforeach
                                 
                            </select>
                            <input type="number" name="time_level" class="form-control col-md-2" required="" autofocus="" style="width: 100%">    
                        </div>
                    </div>
                </div>

            </div>
                  

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
            </form>
                </div>
            </div>
</div>


<!--modal edite ticket client-->

<div class="modal fade" id="ticket-edit-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-modal-Label">

    <div class="modal-dialog model-lg" role="document">

        <div class="modal-content">

            <form method="POST" action="{{url('/updateticketclient')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">

                {{ csrf_field() }}

                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">

                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">

                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">

                <input name="oldpdf" type="hidden" id="novoestado" value="{{$ticket->productimg}}">

            <div class="modal-header">

                <h4 class="modal-title" id="ticket-edit-modal-Label">{{$ticket->assunto}}</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                

            </div>

            <div class="modal-body">



                <div class="col-sm-12">

                    <div class="row"></div>

                    <div class="form-group">

                        <input class="form-control" required="required" name="assunto" type="text" value="{{{ old('assunto')?:$ticket->assunto }}}">

                    </div>

                    <div class="form-group">

                        <textarea class="form-control textarea" rows="5" required="required" name="description" cols="50">

                            {{{ old('description')?:$ticket->description }}}

                        </textarea>

                    </div>

                    
                    <div class="form-group">
                    <div class=" col-lg-6">

                        <label for="prioridade" class="col-lg-6 control-label">Prioridade: </label>

                        <div class="col-lg">     

                            <select  class="form-control" value="{{{ old('prioridade')?:$ticket->prioridade  }}}"  id="prioridade"  name="prioridade" required autofocus style="height: auto">

                                <option value="Baixa"  {{ old('prioridade')=='3' ? 'selected' : ''  }} style="color: #31B0D5 ">Baixa</option>

                                <option value="Normal"  {{ old('prioridade')=='2' ? 'selected' : ''  }} style="color: #EC971F; ">Normal</option>

                                <option value="Alta"  {{ old('prioridade')=='1' ? 'selected' : ''  }} style="color: #e10000 ">Alta</option>

                            </select>

                        </div>

                    </div>



                    <div class=" col-lg-6">

                        <label for="tipodesolicitacao" class="col-lg-6 control-label">Categoria: </label>

                        <div class="col-lg">

                                  <select class="form-control" value="{{{  old('categoria') ?:$ticket->categoria}}}"  id="categoria"  name="categoria" required autofocus  style="height: auto">

                                    <option disabled selected value>Seleciona...</option>

                                     @foreach($category as $cil)

                                    <option value="{{$cil->id}}">

                                        {{$cil->name}}

                                    </option>

                         @endforeach

                                </select>

                            </div>

                    </div>

                    <div class="">
                    <div class=" col-md-12">
                        <label for="subcategoria" class="col-md-12 control-label">Sub-Categoria: </label>
                        <div class="col-md">
                                <select class="form-control" value="{{{old('subcategoria')?: isset($product->subcategoria) }}}"  id="subcategoria"  name="subcategoria" required autofocus style="height: 100%; width: 100%">
                                    <option disabled selected value>Seleciona...</option>
                                    
                                </select>
                            </div>
                    </div>
                    </div>



                </div>
                

        <div class="clearfix"></div>

        <div class="form-group">

            <div class=" col-lg-6">

                <div class="col-lg"> 

                    <input class="form-control" type="number" value="{{{ old('telefone1')?:$ticket->telefone1}}}"  id="telefone1"  name="telefone1" placeholder="Telefone-1.." required autofocus>

                </div>

            </div>



            <div class=" col-lg-6">

                <div class="col-lg">

                    <input class="form-control" type="number" value="{{{ old('telefone2')?:$ticket->telefone2  }}}"  id="telefone2"  name="telefone2" placeholder="Telefone-2.." >

                    </div>

            </div>

        </div>  

        <div class="">

            <div class="">

                <div class="col-lg"> 

                    <input class="form-control" type="email" value="{{{ old('email')?:$ticket->email  }}}"  id="email"  name="email" placeholder="Email.." >

                </div>

            </div>

        </div>   

        <div class="">

            <div class="col-lg-12">

                <div class="col-lg">

                <input type="radio" name="recorentencia" value="Insistência" id="recorentencia" class="form-radio"> <label for="radio-one"> Insistência</label>

                <input type="radio" name="recorentencia" value="1 Solicitação" id="recorentencia" class="form-radio" checked> <label for="radio-one"> 1 Solicitação</label>

                </div>

            </div>

        </div>  

      

                <div class="col-lg"> 

                    <input class="form-control" type="number" value="{{{ old('loanid') ?:$ticket->loanid}}}"  id="loanid"  name="loanid" placeholder="Loanid.." required autofocus>

                </div>

          



            <div class="">

                <div class="col-lg"> 

                       <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{  old('ClientFirstNames')?:$ticket->ClientFirstNames }}}"  id="ClientFirstNames"  name="ClientFirstNames" placeholder="Nome Sobrenome.." required autofocus>

                </div>

            </div>

            <div class="">

                <div class="col-lg"> 

                       <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ old('ClientSurname')?:$ticket->ClientSurname }}}"  id="ClientSurname"  name="ClientSurname" required autofocus placeholder="Apelido..">

                </div>

            </div>

    

            <div class="">

                <div class="col-lg"> 

                     <input class="form-control" type="text" placeholder="NIB.." tyle="width: 100%" style="width: 100%" value="{{{ old('nib')?: $ticket->nib  }}}"  id="nib"  name="nib" required autofocus>

                </div>

            </div>


                         



        </div>
</div>
                  



                    <div class="clearfix"></div>



                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <input class="btn btn-primary" type="submit" value="Submit">

                    </div>

                    </form>

                </div>

            </div>

</div>

<!--modal edite ticket file-->
<div class="modal fade bd-example-modal-lg" id="ticket-edit-file-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-file-modal-Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <form method="POST" action="{{url('/editeaddfiles')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">
                <input name="oldpdf" type="hidden" id="novoestado" value="{{$ticket->productimg}}">
            <div class="modal-header">
                <h4 class="modal-title" id="ticket-edit-file-modal-Label">Ficheiros {{$ticket->assunto}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div> 

            <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row"></div>
                        <div class="form-group">
                            <div class="box-body table-responsive no-padding">
                            <table class="table-responsive-sm table-condensed table  table-hover" cellspacing="0" width="100%" style="font-size:9">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo do Ficheiro</th>
                                    <th>Nome do Ficheiro</th>
                                    <th>Acção</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if(isset($anexos))
                                    @foreach($anexos as $key=>$cil)
                                    <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$cil->file_name}}</td>
                                    <td><strong><a class="fa fa-file " aria-hidden="true" href="{{asset('storage/productimg/'.$cil->filename)}}" target="_self"> {{$cil->filename}}</a></strong>
                                    </td>
                                    <th><strong><a class="fa fa-trash " aria-hidden="true" href="{{route('remove-anexo-form-a',$cil->filename)}}" target="_self"> Remover</a></strong>
                                    </th>
                                    </tr>
                                    @endforeach
                               @endif
                            </tbody>

                        </table>
                        </div>
                    </div>
                    </div>

        <h3>Upload<a style="color: red">*</a></h3>  
          <small id="fileHelp" class="form-text text-muted">Por favor carregue o anexo (jpeg,png,pdf) com os todos documentos. E não pode ser superior à 10MB</small>
          <div class="">
            <select class="form-control"   id="filetype[]"  name="filetype[]" required autofocus style="height: 100%" >
               <option disabled selected>Seleciona...</option>
                        @foreach($file as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
            </select>
          </div>
        <div class="input-group control-group increment" >
          <input type="file" name="productimg[]" class="form-control" >
          <div class="input-group-btn" > 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus" ></i>Add</button>
          </div>
          
        </div>


        <div class="clone hide" >
        <div class="control-group">
          <div class="" style="margin-top:10px">
            <select class="form-control"   id="filetype[]"  name="filetype[]" required autofocus style="height: 100%" >
               <option disabled selected>Seleciona...</option>
                        @foreach($file as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
            </select>
          </div>
          <div class=" input-group" >
            <input type="file" name="productimg[]" class="form-control" >          
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remover</button>
            </div>
          </div>
        </div>
        </div>


             </div>
                  

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
            </form>
                </div>
            </div>
</div>   


<!--modal edite ticket non_client-->
<div class="modal fade bd-example-modal-lg" id="ticket-edit-non-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-non-modal-Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <form method="POST" action="{{url('/updateticketnonclient')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
                <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">
                <input name="oldpdf" type="hidden" id="novoestado" value="{{$ticket->productimg}}">
            <div class="modal-header">
                <h4 class="modal-title" id="ticket-edit-non-modal-Label">{{$ticket->assunto}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div> 

            <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control" required="required" name="assunto" type="text" value="{{{old('assunto') ?:$ticket->assunto}}}">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control textarea" rows="5" required="required" name="description" cols="50">
                                {{{old('description')?: $ticket->description }}}
                            </textarea>
                        </div>
                    </div>   

                    <div class="form-group">
                    <div class="col-md-3">
                        <label for="prioridade" class="col-md-4 control-label">Prioridade: </label>
                        <div class="col-md">     
                            <select  class="form-control" value="{{{old('prioridade') ?: $ticket->prioridade}}}"  id="prioridade"  name="prioridade" required autofocus style="height: auto">
                                <option value="Baixa"  {{ old('prioridade')=='3' ? 'selected' : ''  }} style="color: #31B0D5 ">Baixa</option>
                                <option value="Normal"  {{ old('prioridade')=='2' ? 'selected' : ''  }} style="color: #EC971F; ">Normal</option>
                                <option value="Alta"  {{ old('prioridade')=='1' ? 'selected' : ''  }} style="color: #e10000 ">Alta</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class=" col-md-4">
                        <label for="tipodesolicitacao" class="col-md-4 control-label">Categoria: </label>
                        <div class="col-md">
                                  <select class="form-control" value="{{{  old('categoria')?:$ticket->categoria }}}"  id="categoria1"  name="categoria" required autofocus  style="height: auto">
                                    <option disabled selected value>Seleciona...</option>
                                     @foreach($category as $cil)
                                    <option value="{{$cil->id}}">
                                        {{$cil->name}}
                                    </option>
                                     @endforeach
                                </select>
                            </div>
                    </div>
                    <div class=" col-md-5">
                        <label for="tipodesolicitacao" class="col-md-5 control-label">Sub-Categoria: </label>
                        <div class="col-md">
                                <select class="form-control" value="{{{ old('subcategoria')?:isset($product->subcategoria) }}}"  id="subcategoria"  name="subcategoria" required autofocus style="height: 100%; width: 100%">
                                    <option disabled selected value>Seleciona...</option>
                                    
                                </select>
                            </div>
                    </div>
          


                    </div>

            
        <div class="clearfix"></div>
        
        <div class="form-group">
            <div class="col-md-3">
                <label for="telefone1" class="col-md-4 control-label">Telefone1: </label>
                <div class="col-md"> 
                    <input class="form-control" type="number" value="{{{ old('telefone1') ?: $ticket->telefone1 }}}"  id="telefone1"  name="telefone1" placeholder="Telefone-1.." required autofocus>
                </div>
            </div>
            <div class="col-md-3">
                <label for="telefone1" class="col-md-4 control-label">Telefone2: </label>
                <div class="col-lg">
                    <input class="form-control" type="number" value="{{{old('telefone2') ?: $ticket->telefone2 }}}"  id="telefone2"  name="telefone2" placeholder="Telefone-2.." >
                    </div>
            </div>
            <div class="col-md-6" >
                <label for="telefone1" class="col-md-4 control-label">Email: </label>
                <div class="col-lg" style="width: 100%"> 
                    <input class="form-control" type="email" value="{{{old('email')  ?: $ticket->email }}}"  id="email"  name="email" placeholder="Email.." >
                </div>
            </div>
        </div>    
         

 
        <div class="form-group">
            <div class="col-lg-6">
                <div class="col-lg"> 
                <input type="radio" name="recorentencia" value="Insistência" id="recorentencia" class="form-radio"> <label for="radio-one"> Insistência</label>
                <input type="radio" name="recorentencia" value="1 Solicitação" id="recorentencia" class="form-radio" checked> <label for="radio-one"> 1 Solicitação</label>
                </div>
            </div>
        </div>    
        <div class="col-sm-12">
        </div> 

        <div class="form-group">
            <div class=" col-lg-4">
                <div class="col-lg"> 
                    <input class="form-control" type="number" tyle="width: 100%" style="width: 100%" value="{{{old('nuit') ?: $ticket->nuit }}}"  id="nuit"  name="nuit" placeholder="Nuit.." required autofocus>
                </div>
            </div>
            <div class=" col-lg-8">
                <div class="col-lg"> 
                       <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{old('ClientFirstNames')  ?:$ticket->ClientFirstNames }}}"  id="ClientFirstNames"  name="ClientFirstNames" placeholder="Nome Sobrenome.." required autofocus>
                </div>
            </div>
        </div>         

        <div class="form-group ">
            <div class="col-lg-8">
                <div class="col-lg"> 
                       <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{old('ClientSurname') ?:$ticket->ClientSurname }}}"  id="ClientSurname"  name="ClientSurname" required autofocus placeholder="Apelido..">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="col-lg"> 
                                   
                            <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ old('numerododocumento') ?:$ticket->numerododocumento  }}}"  id="numerododocumento"  name="numerododocumento" required autofocus placeholder="Número do Documento..">
                </div>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-lg-12">
                <div class="col-lg"> 
                        
                        <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ old('entidade') ?:$ticket->entidade}}}"  id="entidade"  name="entidade" required autofocus>
                </div>
            </div>
     
        </div> 
        <div class="form-group">
            <div class=" col-lg-4">
                <div class="col-lg"> 

                        <input class="form-control"  placeholder="Titular da Conta" tyle="width: 100%" style="width: 100%" value="{{{ old('titulardaconta') ?:$ticket->titulardaconta }}}"  id="titulardaconta"  name="titulardaconta" required autofocus>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg"> 

                        <input class="form-control" class="form-control" type="text" placeholder="Nome do Banco" tyle="width: 100%" style="width: 100%" value="{{{ old('nomedobanco') ?:$ticket->nomedobanco }}}"  id="nomedobanco"  name="nomedobanco" required autofocus>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="col-lg"> 
           
                        <input class="form-control" type="text" placeholder="NIB" tyle="width: 100%" style="width: 100%" value="{{{ old('nib') ?:$ticket->nib }}}"  id="nib"  name="nib" required autofocus>
                </div>
            </div>


        </div> 
        </div>
                  

                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                    </form>
                </div>
            </div>
</div>    

    

    <!-- Modal Dialog -->
        <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Ticket</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete ticket: :subject?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm">Delete</button>
              </div>
            </div>
          </div>
        </div>
            <br>
        <h2>Comentários
        <span class="badge">
        {{$nucomment}} 
        </span></h2>

        @foreach($coment as $cil)
                <div class="box box-solid box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{$cil->name}} {{$cil->lname}}</h3>
                    <div class="box-tools pull-right">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                      <span class="label label-primary">{{$cil->updated_at->diffForHumans()}}</span>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    {!! $cil->comentarios!!}
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <span class="time-right"> {{$cil->created_at}} </span>
                  </div>
                  <!-- box-footer -->
                </div>
                <!-- /.box -->

        @endforeach
        {{ $coment->links() }}
<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="{{url('savecommetticket')}}" accept-charset="UTF-8" class="form-horizontal">
          {{ csrf_field() }}
            <input name="idsolicitacao" type="hidden" id="idsolicitacao" value="{{$ticket->id}}">
            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
            <input name="novoestado" type="hidden" id="novoestado" value="{{$ticket->status}}">

            <fieldset>
                <legend>Reply</legend>
                <div class="form-group">
                    <div class="col-lg-12">
                        <textarea class="form-control textarea" rows="3" name="comentarios" cols="50"></textarea>
                    </div>
                </div>

                <div class="text-right col-md-12">
                    <input class="btn btn-primary" type="submit" value="Comentar">
                </div>

            </fieldset>
        </form>
    </div>
</div>

</div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




    <script>
        $(document).ready(function() {
            $( ".deleteit" ).click(function( event ) {
                event.preventDefault();
                if (confirm("Tens a certeza que pretendes apagar? : " + $(this).attr("node") + "?"))
                {   
                    alert("Infelizmente não tens permição para apagar dados")
                    //use this to delete
                    /*var form = $(this).attr("form");
                    $("#" + form).submit();*/
                }

            });
            $('#category_id').change(function(){
                var loadpage = "http://ticketit.kordy.info/tickets/agents/list/" + $(this).val() + "/1";
                $('#agent_id').load(loadpage);
            });
            $('#confirmDelete').on('show.bs.modal', function (e) {
                $message = $(e.relatedTarget).attr('data-message');
                $(this).find('.modal-body p').text($message);
                $title = $(e.relatedTarget).attr('data-title');
                $(this).find('.modal-title').text($title);

                // Pass form reference to modal for submission on yes/ok
                var form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });

            <!-- Form confirm (yes/ok) handler, submits form -->
            $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
                $(this).data('form').submit();
            });
        });
    </script>
        <script>
        $(document).ready(function() {
            $( ".sendtoorgin" ).click(function( event ) {
                event.preventDefault();
                if (confirm("Tens a certeza que pretende enviar para o emissor? : " + $(this).attr("node") + "?"))
                {   
                    //alert("Infelizmente não tens permição para apagar dados")
                    //use this to delete
                    var form = $(this).attr("form");
                    $("#" + form).submit();
                }

            });

            $( ".reopenticket" ).click(function( event ) {
                event.preventDefault();
                if (confirm("Tens a certeza que pretende Reabrir o ticket? : " + $(this).attr("node") + "?"))
                {   
                    //alert("Infelizmente não tens permição para apagar dados")
                    //use this to delete
                    var form = $(this).attr("form");
                    $("#" + form).submit();
                }

            });
    
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.19.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.19.0/mode/xml/xml.min.js"></script>






<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

@section('js')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $('.textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>

        <script type="text/javascript">
    $('#categoria').change (function(){


        $value=$(this).val();
        //alert($value);
        $.ajax({
        type : 'get',

        url : '{{URL::to('searchsubcategory')}}',

        data:{'search':$value},

        success:function(data){
        //alert(data)
        $('select[name="subcategoria"]').html(data);


            }


    })



    });
    </script>
        </script>

        <script type="text/javascript">
    $('#categoria1').change (function(){


        $value=$(this).val();
        //alert($value);
        $.ajax({
        type : 'get',

        url : '{{URL::to('searchsubcategory')}}',

        data:{'search':$value},

        success:function(data){
        //alert(data)
        $('select[name="subcategoria"]').html(data);


            }


    })



    });

    </script>

<script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

  </script>
@stop


@section('css')

  <style type="text/css">
    .mar{
      margin-left: 500px

    }

    .marx{
      margin-left: 380px

    }
    .marbut{
      margin-left: 20px
      margin-right:20px;
    }

    .top{
      margin-top: 30px
    }


    .fotb{
      font-size: 15px;
      font-weight: 500;
      font-weight: bold;
    }

    .fotbbu{
      font-size: 10px;
      font-weight: 500;
      font-weight: bold;
    }

      .fot{
      font-size: 15px;
      font-weight: 500;
    }

    .fotbu{
      font-size: 10px;
      font-weight: 500;
    }

    .posi{
     text-align: center;
    }

    .deco{
      text-decoration: none;
    }
   
    .textjusty{
      text-align: justify;
      text-justify:inter-word;
    }

    .oppa{
      opacity: 0.5;
      filter: alpha(opacity=50);
    }

    .unline{
      text-decoration: underline;
    }

    .time-right {
    float: right;
    color: #aaa;
    }
    .heightauto{
    height: auto
    }

  </style>

    <!--status progress-->
    <style type="text/css">
    .bs-wizard {margin-top: 40px;}

    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    /*END Form Wizard*/
    </style>




@stop


@stop


