@extends('adminlte::page')

@section('title', 'Bayport | New Ticket')

@section('content_header')
    <h1>Novo Ticket</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li role="presentation" class="active">
                <a href="">Novo Ticket
         
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
                @if(Auth::user()->ticket_level=='1')
                <li role="presentation" class="">
                    <a href="http://ticketit.kordy.info/tickets-admin">Dashboard</a>
                </li>

                <li role="presentation" class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Settings 
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" class="">
                            <a href="{{url('agents')}}">Agents</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="{{url('/categories')}}">Categories</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="{{url('/teams')}}">Teams</a>
                        </li>
                    </ul>
                </li>
                @endif
            
        </ul>
    </div>
</div>

               
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{ url('newtticket') }}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Tipo de Cliente</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete complete -->
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Formulario</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete active -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Anexos</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
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
        <div class="row col-lg-4 col-lg-offset-1">
            <div class="info-box" style="width: 100%">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-green"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Cliente Bayport</span>
                <span class="info-box-text">Formúlario Menos Detalhado</span>
                <a href="{{ url('form-ticket-a') }}" class="btn btn-primary btn-flat">Iniciar agora</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        
        <div class="row col-lg-4 col-lg-offset-2">
            <div class="info-box" style="width: 100%">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span class="info-box-icon bg-blue"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Cliente Não Bayport</span>
                <span class="info-box-text">Formúlario Mais Detalhado</span>
                <a  href="{{ url('form-ticket-b') }}" class="btn btn-primary btn-flat">Iniciar agora</a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        </div>        
        
        
        
    </div>


@stop

@section('css')


<style type="text/css">

#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 340px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}

<style>


        h2 {
                margin-bottom: 20px;
                color: #474E69;
                font-family:'Nunito', sans-serif;
        }

        h4 {
                font-family:'Nunito', sans-serif;;
        }
        /* ===========================
             ====== Contact Form =======
             =========================== */

        input, textarea {
                padding: 10px;
                border: 1px solid #E5E5E5;
                width: 200px;
                color: #999999;
                box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
                -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
                -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

        textarea {
                width: 400px;
                height: 400px;
                max-width: 400px;
                line-height: 18px;
        }

        input:hover, textarea:hover,
        input:focus, textarea:focus {
                border-color: 1px solid #C9C9C9;
                box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
                -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
                -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
        }

        .form label {
                margin-left: 10px;
                color: #999999;
        }

        /* ===========================
             ====== Submit Button ======
             =========================== */

        .submit input {
                width: 100px;
                height: 40px;
                background-color: #474E69;
                color: #FFF;
                border-radius: 3px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
        }

        select{
                font-family:'Nunito', sans-serif;
                font-size: 16px;
                box-shadow:rgba(0, 0, 0, 0.1) 0px 0px 8px ;
                color: #999999;
                border: 1px solid #E5E5E5;
                width: 200px;
                height: 41px;
        }

        #textarea{
                resize: horizontal;
                width: 1200px;
                height: 90px;

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

<style>
.container-fluid{

        padding-left: 0px;

        margin-left: 0px;
}
</style>

@stop
