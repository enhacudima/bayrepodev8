@extends('adminlte::page')

@section('title', 'Bayport | New Ticket form')

@section('content_header')
    <h1>Novo Ticket</h1>
@stop

@section('content')

        <div class="pull-right">
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
                
                <div class="col-xs-3 bs-wizard-step active "><!-- complete complete -->
                  <div class="text-center bs-wizard-stepnum">Passo 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Formulario</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete active -->
                  <div class="text-center bs-wizard-stepnum">Passo 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Anexos</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Passso 4</div>
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

    <div class="panel panel-default">

        <div class="panel-body">
            <legend>Para clientes Bayport</legend>
            <form action="{{ url('/create-step-a1') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="tipodecliente" value="Cliente">
            <div class="row">
            <div class="form-group col-md-6" >
                <label for="title">Assunto <a style="color: red">*</a></label>
                <p class="name">
                <input class="form-control" type="text" tyle="width: 100%" style="width: 100%"value="{{{isset($product->assunto) ? $product->assunto : old('assunto')}}}"  id="assunto"  name="assunto" placeholder="Assunto de solicitação.." required autofocus>
                </p>
            </div>
            <div class="form-group col-md-3  col-md-offset">
                <label for="title">Estado<a style="color: red">*</a></label>
                <p class="name">
                <input type="radio" name="status" value="0" id="status" class="form-radio"> <label for="radio-one"> Resolvido</label>
                <input type="radio" name="status" value="1" id="status" class="form-radio" checked> <label for="radio-one"> Não Resolvido</label>
            </p>
            </div>
            <div class="form-group col-md-3  col-md-offset">
                <label for="title">Tipo de Recorência<a style="color: red">*</a></label>
                <p class="name">
                <input type="radio" name="recorentencia" value="Insistência" id="recorentencia" class="form-radio"> <label for="radio-one"> Insistência</label>
                <input type="radio" name="recorentencia" value="1 Solicitação" id="recorentencia" class="form-radio" checked> <label for="radio-one"> 1 Solicitação</label>
            </p>
            </div>
            </div>

            <div class="">
                <div class="form-group col" style="width: 400px">
                    <label for="title">Contacto</label>

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3" >
                    <p class="name">
                    <input style="border-color: red; width: 100%" class="form-control" type="number" value="{{{isset($product->telefone1)?$product->telefone1: old('telefone1') }}}"  id="telefone1"  name="telefone1" placeholder="Telefone-1.." required autofocus>
                    </p>
                </div>

                <div class="form-group col-md-3" >
                    <p class="name">
                    <input class="form-control" style="width: 100%" type="number" value="{{{ isset($product->telefone2)?$product->telefone2: old('telefone2')}}}"  id="telefone2"  name="telefone2" placeholder="Telefone-2.." >
                    </p>
                </div>

                <div class="form-group col-md-6 >
                    <p class="name">
                    <input class="form-control" style="width: 100%" type="email" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->email)?$product->email:old('email') }}}"  id="email"  name="email" placeholder="Email.." >
                    </p>
                </div>
            </div>

            <div class="row">

            <div class="form-group  col-md-2" >
                <label>Nivel de Prioridade<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{ isset($product->prioridade)?$product->prioridade:old('prioridade')}}}"  id="prioridade"  name="prioridade" required autofocus style="height: auto">
                        <option value="Baixa"  {{ old('prioridade')=='3' ? 'selected' : ''  }} style="color: #31B0D5 ">Baixa</option>
                        <option value="Normal"  {{ old('prioridade')=='2' ? 'selected' : ''  }} style="color: #EC971F; ">Normal</option>
                        <option value="Alta"  {{ old('prioridade')=='1' ? 'selected' : ''  }} style="color: #e10000 ">Alta</option>
                    </select>
                </p>
            </div>
            <div class="form-group  col-md-3" >
                <label>Categoria<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{ isset($product->categoria)?$product->categoria:old('categoria') }}}"  id="categoria"  name="categoria" required autofocus style="height: 100%; width: 100%">
                        <option>Seleciona...</option>
                         @foreach($category as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
                    </select>
                </p>
            </div>
            <div class="form-group  col-md-7" >
                <label>Sub-Categoria<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{ isset($product->subcategoria)?$product->subcategoria:old('subcategoria')}}}"  id="subcategoria"  name="subcategoria" required autofocus style="height: 100%; width: 100%">
                        <option disabled value>Seleciona...</option>
                        
                    </select>
                </p>
            </div>
            </div>
        <div class="row">
                <div class="form-group  col-md-3" >
                <label>Meio de Comunicação<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{ isset($product->m_comunicacao)?$product->m_comunicacao:old('m_comunicacao')}}}"  id="m_comunicacao"  name="m_comunicacao" required autofocus style="height: 100%; width: 100%">
                         <option disabled selected="">Seleciona...</option>
                         <option  value="Carta">Carta</option>
                         <option  value="Telefone">Telefone</option>
                         <option  value="Email">Email</option>
                        
                    </select>
                </p>
            </div>
            <div class="form-group col-md-9" >
       

                    <label for="title">Cliente<a style="color: red">*</a></label>
                    <p class="name">
                    <input class="form-control"style="width: 100% type="text"  id="loanidshow"  name="loanidshow" placeholder="Pesquisar por loan id or Nuit.." required autofocus >
                    </p>
                    <input type="hidden" name="loanid" value="" />
               
            </div>
        </div>    

    </div>
</div>
            

            <div class="form-group" >

                <div class="panel panel-default">
                    <div class="panel-body">

                            <fieldset>
                                <legend>Descrição da Solicitação<a style="color: red">*</a></legend>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <textarea class="form-control textarea" rows="3" id="description" name="description" cols="50">{{{isset($product->description)?$product->description:old('description') }}}</textarea>
                                    </div>
                                </div>
                            </fieldset>
                      
                    </div>
                </div>

                <p><strong>Note:</strong> Descreva a sua solicitação de uma forma mas clara..</p>
            </div>

            <p class="submit">
                <input type="submit" value="Avançar" class="btn btn-primary" />
            </p>

            </form>
        </div> 
        </div>
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

    <script>
        $(document).ready(function() {
        $('#loanidshow').autocomplete({
            // delay: 500,
            minLength: 5,

            source: function(request, response) {
                $.getJSON("{{url::to('searchloanid')}}", {
                    search: request.term,
                }, function(data) {
                    response(data);
                });
            },
            focus: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
            },
            select: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
 
                $('input[name="loanidshow"]').val(ui.item.label);
                $('input[name="loanid"]').val(ui.item.LoanID);
                // console.log( ui.item.LoanID ); 
            }
        });
        })
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
