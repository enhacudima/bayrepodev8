@extends('adminlte::page')

@section('title', 'Bayport | CommitTicket')

@section('content_header')
    <h1>Ticket Comentados</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
<div class="panel panel-default" style="width: 100%">

    <div class="panel-body" >

        <ul class="nav nav-pills">

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
                    <a href="">Dashboard</a>
                </li>
                <li role="presentation" class="active">
                <a href="{{ url('committicket') }}">Tickets Activos
                    <span class="badge">
                         {{$committicket}}                    </span>
                </a>
                </li>

                <li role="presentation" class="dropdown ">

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

</div>

            <div>
            <!--Mensagens-->
            @include('messages')
            <!-- /Mensagens-->
            </div>


<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Tickets Comentados
            <a href="{{ url('newtticket') }}" class="btn btn-success btn-xs pull-right">Criar um novo Ticket</a>
        </h4>
    </div>

    <div class="panel-body ">



    <div class="box-body table-responsive no-padding">    
    <table id="reclatodas" class="dataTables_wrapper form-inline dt-bootstrap table-hover" >
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Assunto</th>
            <th scope="col">Status</th>
            <th scope="col">Agente</th>
            <th scope="col">Agencia</th>
            <th scope="col">Prioridade</th>
            <th scope="col">Cliente</th>
            <th scope="col">Categoria</th>
            <th scope="col">Sub-Categoria</th>
            <th scope="col">Recorência</th>
            <th scope="col">Ultima atualização</th>
            <th scope="col">Criado_em</th>
            <th scope="col">Expira_em</th>
            <th scope="col">Detalhes</th>
            <th scope="col">Comentarios</th>

        </tr>
        </thead>
        <tbody>
        @foreach($reclamacoes as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><strong><a aria-hidden="true" href="{{url('viewthisticket', $product->id)}}" target="_self"> {{$product->assunto}}</a></strong></td>
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
                <td>{{$product->tiposolicitacao}}</td>
                <td>{{$product->subcategory}}</td>
                <td>{{$product->recorentencia}}</td>
                <td>{{$product->updated_at->diffForHumans()}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->created_at->addDays($product->time)->diffForHumans()}}</td>
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
                'excel', 'print'
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


