@extends('adminlte::page')

@section('title', 'Bayport | MyTicket')

@section('content_header')
    <h1>Reporte do corrente mês (por defeito)</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <div class="">
      <div class="col-md-4">

        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-exclamation-triangle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tickets Ativos</span>
            <span class="info-box-number">{{$acteticket}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($acteticket/($acteticket+$completticket+$committicket))*100}}%"></div>
            </div>
            <span class="progress-description">
              Por processar nos proximos dias {{ number_format(($acteticket/($acteticket+$completticket+$committicket))*100, 2) }}% 
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>

      </div>

      <div class="col-md-4">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-archive"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tickets Fechados</span>
            <span class="info-box-number">{{$completticket}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($completticket/($acteticket+$completticket+$committicket))*100}}%"></div>
            </div>
            <span class="progress-description">
              Total {{ number_format(($completticket/($acteticket+$completticket+$committicket))*100, 2) }}%
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>


      <div class="col-md-4">
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-snowflake-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tickets Comentados</span>
            <span class="info-box-number">{{$committicket}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($committicket/($acteticket+$completticket+$committicket))*100}}%"></div>
            </div>
            <span class="progress-description">
              Total {{ number_format(($committicket/($acteticket+$completticket+$committicket))*100, 2) }}%
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
    </div>

    <div class="row col-md-12">

    <form id="myForm" name="myForm" action="{{url('/ticketreportfilter')}}" method="post">
                @csrf
                {{ csrf_field() }}
    <div class="">
        <div class="form-group col-sm-2">
                <label >Inicio</label>
                <p class="name">
                        <input type="date" tyle="width: 100%"  id="inicio"  name="inicio" required autofocus>
                </p>

        </div>

        <div class="form-group  col-sm-2">
                <label >Fim</label>
                <p class="name">
                        <input type="date" tyle="width: 100%"  id="fim"  name="fim" required autofocus >
                </p>

        </div>

        <div class="form-group  col-sm-2 col-sm-offset-1">
            <label >Data (Tipo)</label>
            <label class="container">Data de Criação
              <input type="radio" checked="checked" value="criacao" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>
            <label class="container">Data de Atualização
              <input type="radio" value="atualizacao" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>                 
        </div>
        </div>

        <div class="">
        <p class="submit col">
            <strong>
            <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar">Defenir </button>
            </strong>
        </p>

        </div>   


    <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
    <input hidden="" htype="" name="loanid" id="loanid" value="">         


    </form>  
</div>

    <div class="">
    <!-- Mensagens-->
    @include('messages')
    <!-- /Mensagens-->
    </div>


<div class="" >
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Tickets Report
            <a href="" class="btn btn-danger btn-xs pull-right">Apenas 5000 max linhas estão disponiveis</a>
        </h4>
    </div>

    <div class="panel-body ">



    <div class="box-body table-responsive no-padding">    
    <table id="reclatodas" class="table table-bordered table-hover dataTable" >
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Assunto</th>
            <th scope="col">Descrição</th>
            <th scope="col">Status</th>
            <th scope="col">Agente</th>
            <th scope="col">Agencia</th>
            <th scope="col">Prioridade</th>
            <th scope="col">Cliente</th>
            <th scope="col">Tipo de Cliente</th>
            <th scope="col">Nuit</th>
            <th scope="col">Entidade</th>
            <th scope="col">DI</th>
            <th scope="col">Numero de DI</th>
            <th scope="col">DI Emetido em:</th>
            <th scope="col">Local de emição de DI</th>
            <th scope="col">Nome do Banco</th>
            <th scope="col">NIB</th>
            <th scope="col">Titular da conta</th>
            <th scope="col">Telefone 1</th>
            <th scope="col">Telefone 1</th>
            <th scope="col">Email</th>
            <th scope="col">Provincia</th>
            <th scope="col">Categoria</th>
            <th scope="col">Sub-Categoria</th>
            <th scope="col">Recorência</th>
            <th scope="col">Ultima atualização</th>
            <th scope="col">Data atualização</th>
            <th scope="col">Criado_em</th>
            <th scope="col">Expira_em</th>
            <th scope="col">Meio de Comunicação</th>
            <th scope="col">Data do Fecho</th>
            <th scope="col">Detalhes</th>
            <th scope="col">Comentarios</th>
            <th scope="col">Comentarios do fecho</th>

            

        </tr>
        </thead>
        <tbody>
        @foreach($reclamacoes as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><strong><a aria-hidden="true" href="{{url('viewthisticket', $product->id)}}" target="_self" > {{$product->assunto}}</a></strong></td>
                <td>{!!$product->description!!}</td>
                @if($product->status == 0)
                    <td><span class="aprovado">FPoC</span></td>
                @elseif($product->status == 2)
                    <td><span class="aprovado">Completed</span></td>
                @elseif($product->status == 1)
                    <td><span class="rejeitado">Active</span></td>
                @elseif($product->status == 3)
                    <td><span class="rejeitado">Resended to Orgin</span></td>
                @endif
                <td>{{$product->name}} {{$product->lname}}</td>
                <td>{{$product->outletSyncNameCorrected}}</td>
                @if($product->prioridade == "Alta")
                    <td><span style="color: #e10000">Alta</span></td>
                @elseif($product->prioridade == "Normal")
                    <td><span  style="color: #EC971F">Normal</span></td>
                @elseif($product->prioridade == "Baixa")
                    <td><span  style="color: #31B0D5">Baixa</span></td>
                @endif
                <td>{{$product->ClientFirstNames}} {{$product->ClientSurname}}</td>
                <td>{{$product->tipodecliente}}</td>
                <td>{{$product->nuit}}</td>
                <td>{{$product->entidade}}</td>
                <td>{{$product->documentodeidentificacao}}</td>
                <td>{{$product->numerododocumento}}</td>
                <td>{{$product->emitidoem}}</td>
                <td>{{$product->provinciade}}</td>
                <td>{{$product->nomedobanco}}</td>
                <td>{{$product->nib}}</td>
                <td>{{$product->titulardaconta}}</td>
                <td>{{$product->telefone1}}</td>
                <td>{{$product->telefone2}}</td>
                <td>{{$product->email}}</td>
                <td>{{$product->province}}</td>
                <td>{{$product->tiposolicitacao}}</td>
                <td>{{$product->subcategory}}</td>
                <td>{{$product->recorentencia}}</td>
                <td>{{$product->updated_at->diffForHumans()}}</td>
                <td>{{$product->updated_at}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->created_at->addDays($product->time)->diffForHumans()}}</td>
                <td>{{$product->m_comunicacao}}</td>
                <td>{{$product->data_fecho}}</td>
                <td scope="col">
                   
                    <p class="submit">
                        <button type="submit" data-toggle="popover" class="btnNhacudima btn btn-info btn-xs bord0" value="{{$product->id}}" id="btnNhacudima"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </p>
                </td>
                <td>    
                    <p class="submit">
                        <button type="submit" data-toggle="popover" class="btnNhacudima btn btn-info btn-xs bord0" value="{{$product->id}}" id="btnNhacudimaComentarios">Comentarios</button>
                    </p>

                        
                </td>
                <td>{!!$product->comentario_fecho!!}</td>
               


            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
    </div>
</div>
</div>



    <!--Detalhes-->
    <div id="myModal2" class="modal">

        <!-- Modal content -->
        <div class="modal-content" style="margin-bottom: 50px">
            <div class="modal2-header">
                <span class="close2">&times;</span>
            </div>

             <div class="example1" id="example1" name="example1">

            </div>
            


        </div>
    </div>

    <!--Comentarios-->
    <div id="myModal3" class="modal" >

        <!-- Modal content -->
        <div class="modal-content" style="margin-bottom: 50px">
            <div class="modal2-header">
                <span  class="close3">&times;</span>
            </div>
            
            <div class="example" id="example" name="example">

            </div>




        </div>
    </div>




        <!-- JavaScript de Popup de Detalhes -->
        <script>
            var jqxhr = {abort: function () {}};

           $(document).on('click', 'button[id=btnNhacudima]',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).val();
                    //alert($value);

                    jqxhr.abort();
                    jqxhr =$.ajax({

                        type : 'get',

                        url : '{{URL::to('searchcabecalho')}}',

                        data:{'searchcabecalho':$value},

                        success:function(data){

                            $('#example1') .html(data);

                            //alert(data);


                        }

                    });

                  
                    // Get the modal
                    var modal2 = document.getElementById('myModal2');

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close2")[0];

                    // When the user clicks the button, open the modal
                    modal2.style.display = "block";

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal2.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal2) {
                            modal2.style.display = "none";
                        }
                    }
                
            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        </script>

        <!-- JavaScript de Popup de Comentarios -->
        <script>
            var jqxhr = {abort: function () {}};

           $(document).on('click', 'button[id=btnNhacudimaComentarios]',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).val();
                    //alert($value);

                    jqxhr.abort();
                    jqxhr =$.ajax({

                        type : 'get',

                        url : '{{URL::to('detalhes')}}',

                        data:{'detalhes':$value},

                        success:function(data){

                            $('#example') .html(data);

                            //alert(data);


                        }

                    });

                  
                    // Get the modal
                    var modal2 = document.getElementById('myModal3');

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close3")[0];

                    // When the user clicks the button, open the modal
                    modal2.style.display = "block";

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal2.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal2) {
                            modal2.style.display = "none";
                        }
                    }
                
            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        </script>








    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>





@section('js')

<script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>


    <script>
         
    $(document).ready(function() {
        $('#reclatodas').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 11, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel'
            ],

        } );
    } );
    </script>


@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css">   

<style type="text/css">
    .dataTables_wrapper .dt-buttons {
  float:none;  
  text-align:center;
  margin-bottom: 30px;
}
</style>


 <!-- Style da janela de Popup -->
    <style>



        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-bottom: 100px;
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 40%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        /* The Close Button */
        .close1 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close1:hover,
        .close1:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* The Close Button2 */
        .close2 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close2:hover,
        .close2:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        /* The Close Button 3*/
        .close3 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close3:hover,
        .close3:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* The Close Button 4*/
        .close4 {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close4:hover,
        .close4:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #474E69;
            color: white;
        }

        .modal2-header {
            padding: 2px 16px;
            background-color: #474E69;
            color: white;

        }

        .modal-body {padding: 2px 16px;}

        .modal-footer {
            padding: 2px 16px;
            background-color: #474E69;
            color: white;
        }
    </style>

    <style>
        .pendente{
            color: #adae26;
        }
        .rejeitado{
            color: #ef1908;
        }

        .enviado{
            color: #0f20b3;
        }

        .aprovado{
            color: #25b347;
        }
        .emanalise{
            color: #fe6bdd;
        }
    </style>

<!--tipo chat-->
    <style>

        .container1 {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            margin-left:37px;
            margin-right:37px;
        }


        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container1::after {
            content: "";
            clear: both;
            display: table;
        }

        .container1 img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container1 img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }

</style>

@stop


@stop

