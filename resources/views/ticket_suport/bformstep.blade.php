@extends('adminlte::page')

@section('title', 'Bayport | New Ticket form')

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
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{ url('newtticket') }}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Tipo de Cliente</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active "><!-- complete complete -->
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

    <div class="panel panel-default">
        <div class="panel-body">

            <legend>Para clientes Não Bayport</legend>
            <form action="{{ url('/create-step-b1') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="tipodecliente" value="Non">
            <div class="row">
            <div class="form-group col-md-6" >
                <label for="title">Assunto<a style="color: red">*</a></label>
                <p class="name">
                <input class="form-control" type="text" tyle="width: 100%" style="width: 100%"value="{{{isset($product->assunto)?$product->assunto:old('assunto')}}}"  id="assunto"  name="assunto" placeholder="Assunto de solicitação.." required autofocus>
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

            <div class="row">

            <div class="form-group  col-md-2" >
                <label>Nivel de Prioridade<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{isset($product->prioridade)?$product->prioridade:old('prioridade') }}}"  id="prioridade"  name="prioridade" required autofocus style="height: auto">
                        <option value="Baixa"  {{ old('prioridade')=='3' ? 'selected' : ''  }} style="color: #31B0D5 ">Baixa</option>
                        <option value="Normal"  {{ old('prioridade')=='2' ? 'selected' : ''  }} style="color: #EC971F; ">Normal</option>
                        <option value="Alta"  {{ old('prioridade')=='1' ? 'selected' : ''  }} style="color: #e10000 ">Alta</option>
                    </select>
                </p>
            </div>
            <div class="form-group  col-md-4 col-md-offset-1" >
                <label>Categoria<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{  isset($product->categoria)?$product->categoria:old('categoria') }}}"  id="categoria"  name="categoria" required autofocus style="height: 100%">
                        <option>Seleciona...</option>
                         @foreach($category as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
                    </select>
                </p>
            </div>
            <div class="form-group  col-md-5" >
                <label>Sub-Categoria<a style="color: red">*</a></label>

                <p class="name">
                    <select class="form-control" value="{{{  isset($product->subcategoria)?$product->subcategoria:old('subcategoria') }}}"  id="subcategoria"  name="subcategoria" required autofocus style="height: 100%; width: 100%">
                        <option disabled value>Seleciona...</option>
                        
                    </select>
                </p>
            </div>

            </div>

                
            <input type="hidden" name="tipodecliente" value="Non">

            <div class="">
                <div class="form-group col-md" style="width: 400px">
                    <label for="title">Contacto</label>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <p class="name">
                    <input style="border-color: red"  style="width: 100%" class="form-control" type="number" value="{{{ isset($product->telefone1)?$product->telefone1:old('telefone1') }}}"  id="telefone1"  name="telefone1" placeholder="Telefone-1.." required autofocus>
                    </p>
                </div>

                <div class="form-group col-md-3 col-md-offset" >
                    <p class="name">
                    <input class="form-control"  style="width: 100%" type="number" value="{{{  isset($product->telefone2)?$product->telefone2:old('telefone2') }}}"  id="telefone2"  name="telefone2" placeholder="Telefone-2.." >
                    </p>
                </div>

                <div class="form-group col-md-6 col-md-offset">
                    <p class="name">
                    <input class="form-control" type="email" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->email)?$product->email:old('email') }}}"  id="email"  name="email" placeholder="Email.." >
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3 ">
                    <label >NUIT<a style="color: red">*</a></label>
                    <p class="name">
                        <input class="form-control" type="number" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->nuit)?$product->nuit:old('nuit')}}}"  id="nuit"  name="nuit"  autofocus>
                    </p>

                </div>



                <div class="form-group  col-md-5 col-md-offset">
                    <label>Nome & Sobre Nome:<a style="color: red">*</a></label>
                    <p class="name">
                       <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->ClientFirstNames)?$product->ClientFirstNames:old('ClientFirstNames')}}}"  id="ClientFirstNames"  name="ClientFirstNames" required autofocus>
                    </p>

                </div>

                <div class="form-group  col-md-4 col-md-offset">
                    <label>Apelido:<a style="color: red">*</a></label>
                    <p class="name">
                       <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->ClientSurname)?$product->ClientSurname:old('ClientSurname') }}}"  id="ClientSurname"  name="ClientSurname" required autofocus>
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
                <div class="form-group  col-md-9">
                    <label for="title">Entidade<a style="color: red">*</a></label>
                    <p class="name">
                        <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->entidade)?$product->entidade:old('entidade')}}}"  id="entidade"  name="entidade" required autofocus>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="form-group  col-md-3" >
                    <label>Documento de Identificação<a style="color: red">*</a></label>

                    <p class="name">
                        <select class="form-control" tyle="width: 100%" style="width: 100%"  value="{{{ isset($product->documentodeidentificacao)?$product->documentodeidentificacao:old('documentodeidentificacao') }}}"  id="documentodeidentificacao"  name="documentodeidentificacao"  autofocus style="height: auto">
                            @if(old('documentodeidentificacao'))
                            <option value="{{old('documentodeidentificacao')}}"selected>{{old('documentodeidentificacao')}}</option>
                            @endif
                            <option disabled value>Seleciona...</option>
                            <option value="BI">
                                Bilhete de Identidade
                            </option>
                            <option value="Passaporte">
                                Passaporte
                            </option>
                        </select>
                    </p>
                </div>




                    <div class="form-group col-md-4 col-md-offset-1">
                        <label>Número:<a style="color: red">*</a></label>
                        <p class="name">
                            <input class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->numerododocumento)?$product->numerododocumento:old('numerododocumento')}}}"  id="numerododocumento"  name="numerododocumento"  autofocus>
                        </p>

                    </div>
                    <div class="form-group col-md-3 col-md-offset-1">
                        <label>Data de Nascimento:<a style="color: red">*</a></label>
                        <p class="name">
                            <input class="form-control" type="date" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->datadenascimento)?$product->datadenascimento:old('datadenascimento') }}}"  id="datadenascimento"  name="datadenascimento"  autofocus>
                        </p>

                    </div>
                </div>

                        <div class="row">
                        <div class="form-group  col-md-5" >
                                <label>Emitido em<a style="color: red">*</a></label>
                                <p class="name">
                                    <input  class="form-control" type="text" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->emitidoem)?$product->emitidoem:old('emitidoem') }}}"  id="emitidoem"  name="emitidoem"  autofocus>

                                </p>
                            </div>

                            <div class="form-group col-md-4 col-md-offset">
                                <label>Província de<a style="color: red">*</a></label>
                                <p class="name">
                                    <select class="form-control"  tyle="width: 100%" style="width: 100%" value="{{{ isset($product->provinciade)?$product->provinciade:old('provinciade')}}}"  id="provinciade"  name="provinciade"  autofocus style="height: auto">
                                    @if(old('provinciade'))
                                    <option value="{{old('provinciade')}}"selected>{{old('provinciade')}}</option>
                                    @endif
                                    <option disabled value>Seleciona...</option>
                                    <option value="Maputo">Maputo</option>
                                    <option value="Maputo Provincia">Maputo Provincia</option>
                                    <option value="Gaza">Gaza</option>
                                    <option value="Inhambane">Inhambane</option>
                                    <option value="Sofala">Sofala</option>
                                    <option value="Zambezia">Zambezia</option>
                                    <option value="Manica">Manica</option>
                                    <option value="Tete">Tete</option>
                                    <option value="Niassa">Niassa</option>
                                    <option value="Nampula">Nampula</option>
                                    <option value="Cabo delegado">Cabo delegado</option>

                                    </select>
                                </p>

                            </div>



                            <div class="form-group  col-md-3 col-md-offset">
                                <label>Data de Emissão:<a style="color: red">*</a></label>
                                <p class="name">
                                    <input class="form-control" type="date" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->datadeemissao)?$product->datadeemissao:old('datadeemissao')}}}"  id="datadeemissao"  name="datadeemissao"  autofocus>
                                </p>

                            </div>

                        </div>


                            <div class="">
                            <div class="form-group col" style="width: 400px">
                                <label for="title">Detalhes Bancários<a style="color: red">*</a></label>

                            </div>
                            </div>

                        <div class="row">

                            <div class="form-group col-md-4">

                                <p class="name">
                                    <input class="form-control" class="form-control" type="text" placeholder="Nome do Banco" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->nomedobanco)?$product->nomedobanco:old('nomedobanco') }}}"  id="nomedobanco"  name="nomedobanco"  autofocus>
                                </p>
                            </div>

                            <div class="form-group col-md-4 col-md-offset">

                                <p class="name">
                                    <input class="form-control" type="text" placeholder="NIB" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->nib)?$product->nib:old('nib') }}}"  id="nib"  name="nib"  autofocus>
                                </p>

                            </div>



                            <div class="form-group col-md-4 col-md-offset">

                                <p class="name">
                                    <input class="form-control"  placeholder="Titular da Conta" tyle="width: 100%" style="width: 100%" value="{{{ isset($product->titulardaconta)?$product->titulardaconta:old('titulardaconta') }}}"  id="titulardaconta"  name="titulardaconta"  autofocus>
                                </p>

                            </div>

                        </div>

            </div>
         </div> 
         
            <div class="form-group" >


                <div class="panel panel-default">
                    <div class="panel-body">

                            
                                <legend>Descrição da Solicitação<a style="color: red;font-size: 9">*</a></legend>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <textarea class="form-control textarea" rows="3" id="description" name="description" cols="50">{{{ isset($product->description)?$product->description:old('description')}}}</textarea>
                                    </div>
                                </div>
                      
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
