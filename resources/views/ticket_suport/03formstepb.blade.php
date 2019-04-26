@extends('adminlte::page')

@section('title', 'Bayport | New Ticket send')

@section('content_header')
    <h1>Novo Ticket</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <div class="pull-right" style="margin-right: 10px">
            <div class="row">
                 <a class="btn btn-primary col-md-4" href="{{url('conselartickitet')}}" style="width: 100%"> Cancelar</a>
            </div>

           <div class="row">
            <a class="btn btn-primary col-md-4" href="{{ url()->previous() }}" style="width: 100%; margin-top: 10px"> Voltar</a>
           </div> 
        </div>   
        
<div class="container">

        

        
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Passo 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{ url('newtticket') }}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Tipo de Cliente</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step complete "><!-- complete complete -->
                  <div class="text-center bs-wizard-stepnum">Passo 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{url('form-ticket-b-back')}}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Formulario</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step complete"><!-- complete active -->
                  <div class="text-center bs-wizard-stepnum">Passo 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{url('form-ticket-b-1')}}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Anexos</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Passo 4</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Revisão e Submissão</div>
                </div>
            </div>
            <div>
            <!--Mensagens-->
            @include('messages')
            <!-- /Mensagens-->
            </div>

        <hr>
        <div class="">
          <form action="{{ url('/gravar') }}" method="post" >
        {{ csrf_field() }}



        <table class="table table-striped table-hover">
          @if(isset($product))
            
            <tr>
                <td>NUIT:</td>
                <td><strong>{{$product->nuit}}</strong></td>
            </tr>
            <tr>
                <td>Nome do Cliente:</td>
                <td><strong>{{$product->ClientFirstNames}}</strong></td>
            </tr>
            <tr>
                <td>Apelido:</td>
                <td><strong>{{$product->ClientSurname}}</strong></td>
            </tr>
            <tr>
                <td>Telefone-1:</td>
                <td><strong>{{$product->telefone1}}</strong></td>
            </tr>
            <tr>
                <td>Telefone-2:</td>
                <td><strong>{{$product->telefone2}}</strong></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><strong>{{$product->email}}</strong></td>
            </tr>

            <tr>
                <td>Entidade:</td>
                <td><strong>{{$product->entidade}}</strong></td>
            </tr>
            <tr>
                <td>Documento de Identificação:</td>
                <td><strong>{{$product->documentodeidentificacao}}</strong></td>
            </tr>
            <tr>
            <td>Data de Nascimento:</td>
                <td><strong>{{$product->datadenascimento}}</strong></td>
            </tr>
            <tr>
                <td>Número do Documento:</td>
                <td><strong>{{$product->numerododocumento}}</strong></td>

            </tr>

            <tr>
                <td>Nome do Banco Associado ao Cliente:</td>
                <td><strong>{{$product->nomedobanco}}</strong></td>
            </tr>

            <tr>
                <td>Número Único de Identiicação Bancária (NIB):</td>
                <td><strong>{{$product->nib}}</strong></td>
            </tr>

            <tr>
                <td>Titular da conta:</td>
                <td><strong>{{$product->titulardaconta}}</strong></td>
            <tr>
                <td>Assunto:</td>
                <td><strong>{{$product->assunto}}</strong></td>

            </tr>

            <tr>
                <td>Descrição da Solicitação:</td>
                <td>{!!$product->description!!}</td>
            </tr>
            <tr>
                <td>Anexo:</td>
                <td><strong><a class="fa fa-file" aria-hidden="true" href="{{url('anexosticket',$product->productImg)}}" target="_self"> PDF</a></strong></td>



            </tr>
        </table>

        @endif
        <button type="submit" class="btn btn-primary">Submeter</button>
    </form>
  
        </div>        
        
        
        
    </div>

@stop

@section('js')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $('.textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
@stop

@section('css')



<style type="text/css">



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
