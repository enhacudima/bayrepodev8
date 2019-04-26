@extends('layouts.principal')

@section('content')

    <style>
        body {
            padding: 50px 100px;
            font-size: 13px;
            font-style: Verdana, Tahoma, sans-serif;
        }

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

    <style>
    .container-fluid{
        
        padding-left: 0px;
        
        margin-left: 0px;
    }
    </style>
    <!-- Mensagens-->
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    @if ( Session::has('error') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- /Mensagens-->

    <h2 style="text-align: center">Formulário de Solicitação de Reembolso</h2>


    <hr>



    <!-- Corpo principal!!!!-->
        <div class="col-md-12">



            <div class="col-md-6">
                <h4 >Para clientes Bayport</h4>
            <form action="{{ url('/create-step1') }}" method="post">


            {{ csrf_field() }}
                <input type="hidden" name="tipodecliente" value="Cliente">



            <div class="form-group" style="width: 400px">
                <label for="title">Loan ID</label>
                <p class="name">
                <input type="number" value="{{{ $product->name or '' }}}"  id="loanid"  name="loanid" required autofocus>
                </p>
            </div>


            <br>

            <div class="form-group" style="width: 600px;">
                <label for="description">Descrição da Solicitação</label>
                <p class="text">
                <textarea type="text"  id="description" name="description" required autofocus>{{{ $product->description or '' }}} </textarea>
                </p>
            </div>

            <p class="submit">
                <input type="submit" value="Avançar"/>
            </p>

            </form>
            </div>

    <!-- Corpo principal!!!!-->

            <div class="col-md-6">

                    <form action="{{ url('/create-step1B') }}" method="post">
                    {{ csrf_field() }}
                            <h4>Para não clientes Bayport</h4>

                        <input type="hidden" name="tipodecliente" value="Non">

                        <div class="row ">
                            <div class="form-group col-sm-4 ">
                                <label >NUIT</label>
                                <p class="name">
                                    <input type="number" tyle="width: 100%" value="{{{ $product->name or '' }}}"  id="nuit"  name="nuit" required autofocus>
                                </p>
                                
                            </div>


                        
                        <div class="form-group  col-sm-7 col-sm-offset-1">
                            <label>Nome:</label>
                            <p class="name">
                               <input type="text" style="width: 100%" value="{{{ $product->name or '' }}}"  id="nome"  name="nome" required autofocus>
                            </p>

                        </div>
                        </div>


                        <div class="row">   
                            <div class="form-group  col-sm-12">
                                <label for="title">Entidade</label>
                                <p class="name">
                                    <input type="text" style="width: 100%" value="{{{ $product->name or '' }}}"  id="entidade"  name="entidade" required autofocus>
                                </p>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="form-group  col-sm-4" >
                                <label>Documento de Identificação</label>

                                <p class="name">
                                    <select  value="{{{ $product->name or '' }}}"  id="documentodeidentificacao"  name="documentodeidentificacao" required autofocus>
                                        <option>Seleciona...</option>
                                        <option value="BI">
                                            Bilhete de Identidade
                                        </option>
                                        <option value="Passaporte">
                                            Passaporte
                                        </option>
                                    </select>
                                </p>
                            </div>




                            <div class="form-group col-sm-7 col-sm-offset-1">
                                <label>Número:</label>
                                <p class="name">
                                    <input type="text" style="width: 100%" value="{{{ $product->name or '' }}}"  id="numerododocumento"  name="numerododocumento" required autofocus>
                                </p>

                            </div>
                        </div>

                        <div class="row">
                        <div class="form-group  col-sm" >
                                <label>Emitido em</label>
                                <p class="name">
                                    <input type="text" style="width:100%" value="{{{ $product->name or '' }}}"  id="emitidoem"  name="emitidoem" required autofocus>

                                </p>
                            </div>

                            <div class="form-group col-sm-4 col-sm-offset">
                                <label>Província de</label>
                                <p class="name">
                                    <select  style="width: 100%" value="{{{ $product->name or '' }}}"  id="provinciade"  name="provinciade" required autofocus>
                                    <option>Seleciona...</option>
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



                            <div class="form-group  col-sm-3 col-sm-offset">
                                <label>Data de Emissão:</label>
                                <p class="name">
                                    <input type="date" style="width: 100%" value="{{{ $product->name or '' }}}"  id="datadeemissao"  name="datadeemissao" required autofocus>
                                </p>

                            </div>

                        </div>


                            <div class="row">
                            <div class="form-group col" style="width: 400px">
                                <label for="title">Detalhes Bancários</label>

                            </div>
                            </div>

                        <div class="row">

                            <div class="form-group col-sm-4">

                                <p class="name">
                                    <input type="text" placeholder="Nome do Banco" style="width: 100%" value="{{{ $product->name or '' }}}"  id="nomedobanco"  name="nomedobanco" required autofocus>
                                </p>
                            </div>

                            <div class="form-group col-sm-4 col-sm-offset">

                                <p class="name">
                                    <input type="text" placeholder="NIB" style="width: 100%" value="{{{ $product->name or '' }}}"  id="nib"  name="nib" required autofocus>
                                </p>

                            </div>



                            <div class="form-group col-sm-4 col-sm-offset">

                                <p class="name">
                                    <input  placeholder="Titular da Conta" style="width: 100%" value="{{{ $product->name or '' }}}"  id="titulardaconta"  name="titulardaconta" required autofocus>
                                </p>

                            </div>

                        </div>

                        <div class="row">


                            <div class="form-group col-sm-12">
                                <label for="description">Descrição da Solicitação</label>
                                <p class="text">
                                    <textarea type="text"  id="textarea" name="description" required autofocus>{{{ $product->description or '' }}} </textarea>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                        <p class="submit col">
                                <input type="submit" value="Avançar"/>
                        </p>
                        </div>

                        <br>







                    </form>
            </div>

        </div>

@endsection
