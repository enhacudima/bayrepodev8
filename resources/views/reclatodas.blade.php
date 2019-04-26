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
        }

        /* ===========================
           ====== Contact Form =======
           =========================== */

        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 100%;
            color: #999999;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

        textarea {
            width: 100%;
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

        #formulario{
            margin-left: 37px;
            margin-right:37px;
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
        .close {
            color: #ff5f2c;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
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
    <!-- /Mensagens-->

    <table id="reclatodas" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tipo de Cliente</th>
            <th scope="col">Loan ID</th>
            <th scope="col">NUIT</th>
            <th scope="col">Nome do Cliente</th>
            <th scope="col">Apelido</th>
            <th scope="col">Descrição da Solicitação</th>
            <th scope="col">Anexos</th>
            <th scope="col">Submetida por</th>
            <th scope="col">Data de submissão</th>
            <th scope="col">Data de última alteração</th>
            <th scope="col">Estado</th>
            <th scope="col">Editar estado</th>
            <th scope="col">Histórico</th>

        </tr>
        </thead>
        <tbody>
        @foreach($reclamacoes as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->tipodecliente}}</td>
                <td>{{$product->loanid}}</td>
                <td>{{$product->nuit}}</td>
                <td>{{$product->ClientFirstNames}}</td>
                <td>{{$product->ClientSurname}}</td>
                <td>{{$product->description}}</td>
                <td><strong><a class="fa fa-file fa-lg" aria-hidden="true" href="{{asset('storage/productimg/'.$product->productimg)}}" target="_self"> PDF</a></strong></td>
                <td>{{$product->name}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
                @if($product->status == 1)
                    <td><span class="pendente">Pendente</span></td>
                @elseif($product->status == 2)
                    <td><span class="emanalise">Em análise</span></td>
                @elseif($product->status == 3)
                    <td><span class="enviado">Enviado para Aprovação</span></td>
                @elseif($product->status == 4)
                    <td><span class="rejeitado">Rejeitado</span></td>
                @elseif($product->status == 5)
                    <td><span class="aprovado">Aprovado</span></td>
                @elseif($product->status == 6)
                    <td><span class="pendente">Pagamento pendente</span></td>
                @elseif($product->status == 7)
                    <td><span class="aprovado">Pago</span></td>

                @endif
                <td>

                    <p class="submit">
                        <button type="submit" class="btnEmidio btn btn-primary" value="{{$product->id}}" id="btn"  {{ !($product->status==1||$product->status==2) ? "disabled" : ''}} >Editar</button>


                    </p>
                </td>
                <td>

                    <p class="submit">
                        <button type="submit" data-toggle="popover" class="btnNhacudima btn btn-primary" value="{{$product->id}}" id="btnNhacudima">Detalhes</button>


                    </p>

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- The Modal 2222 -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>

            </div>
            <form id="formulario" action="{{ url('/gravaralteracao') }}" method="post">

            {{ csrf_field() }}




                <div class="form-group" style="width: 100%">

                    <p>ID <input type="text" id="idsolicitacao" value="" name="idsolicitacao" style="width:100px" readonly></p>


                    <hr>
                    <label for="title">Estado</label>

                    <p class="name">
                        <select  id="novoestado"  name="novoestado" required autofocus>
                            <option value="2">Em análise</option>
                            <option value="3">Enviar para aprovação</option>
                        </select>

                    </p>

                    <div class="form-group">
                        <label>Data estimada para finalização do processo:</label>
                        <p class="name">
                            <input   type="date" style="width: 300px" value="{{{ $product->name or '' }}}"  id="datafinalizacao"  name="datafinalizacao" required autofocus>
                        </p>

                    </div>
                </div>


                <br>

                <div class="form-group" style="width: 100%;">
                    <label for="description">Comentários</label>
                    <p class="text">
                        <textarea type="text" style="height: 120px"  id="comentarios" name="comentarios" required autofocus></textarea>
                    </p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p class="submit">
                    <input type="submit" value="Alterar Estado"/>
                    <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
                </p>

            </form>
        </div>
    </div>

    <div id="myModal2" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal2-header">
                <span class="close2">&times;</span>
            </div>

             <div class="example1" id="example1" name="example1">

            </div>
            
            <div class="example" id="example" name="example">

            </div>




        </div>
    </div>


    <script>

        $(document).ready(function() {
            $('#reclatodas').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                ]
            } );
        } );

    </script>


        <!-- JavaScript da Janela de Popup -->
        <script>
            $(document).on('click', 'button[id=btn]',(function() {//using delegaction to send event on dynamic datatable

                              



                    $value=$(this).val();
                    //alert($value);

                    // Get the modal
                    var modal = document.getElementById('myModal');
                    $("#idsolicitacao").val($value);

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    // When the user clicks the button, open the modal
                    modal.style.display = "block";

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }


                    
                
            }));


        </script>

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

                   // jqxhr.abort();
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






    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>







@endsection
