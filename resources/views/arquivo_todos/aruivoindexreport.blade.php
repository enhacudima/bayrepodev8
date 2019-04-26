@extends('adminlte::page')

@section('title', 'Bayport | Report')

@section('content_header')
    <h1>Arquivo Master</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

<div class="row">

    <form id="myForm" name="myForm" action="{{url('/arquivofiltroreport')}}" method="post">
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
            <label >Data</label>
            <label class="container">Data de Criação
              <input type="radio" checked="checked" value="criacao" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>
            <label class="container">Data de Atualização
              <input type="radio" value="atualizacao" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>        
            <label class="container">Data do Loan
              <input type="radio" value="loan" id="radio" name="radio">
              <span class="checkmark"></span>
            </label>
            

        </div>
        <div class="form-group  col-sm-2 col-sm-offset-1">
            <label >Ver/Excel</label>
            <label class="container">Ver
              <input type="radio" checked="checked" value="ver" id="radio2" name="radio2">
              <span class="checkmark"></span>
            </label>
            <label class="container">Excel
              <input type="radio" value="excel" id="radio2" name="radio2">
              <span class="checkmark"></span>
            </label>

        </div>
        </div>

        <div class="">
        <p class="submit col">
            <strong>
            <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar">Filtrar</button>
            </strong>
        </p>

        </div>   


    <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
    <input hidden="" htype="" name="loanid" id="loanid" value="">         


    </form>  
</div>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>My Active Tickets 
            
        </h4>
    </div>

    <div class="panel-body ">



    <div class="box-body table-responsive no-padding"> 

    <table id="reclatodas" class="table-bordered dataTables_wrapper form-inline dt-bootstrap table-hover" cellspacing="0" width="100%">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Referencia</th>
            <th scope="col">Loan ID</th>
            <th scope="col">Numero do formulario</th>
            <th scope="col">Apolice de Seguro</th>
            <th scope="col">Nuit</th>
            <th scope="col">BI</th>
            <th scope="col">Localização do Ficheiro</th>
            <th scope="col">Arquivado em</th>
            <th scope="col">Provimento</th>
            <th scope="col">status</th>
            <th scope="col">Observação</th>
            <th scope="col">Número de Paginas</th>
            <th scope="col">Extrato</th>
            <th scope="col">NIB</th>
            <th scope="col">Declaração de Salario</th>
            <th scope="col">Folha de Salario</th>
                        <th scope="col">Outros</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Criado em:</th>
                        <th scope="col">Atualizado em:</th>

        </tr>
        </thead>
        <tbody>
        @foreach($data as $cil)
            <tr>
                <th scope="row">{{$cil->id}}</th>
                <td>{{$cil->loanid}}</td>
                                <td>{{$cil->nform}}</td>
                                <td>{{$cil->apoliceseguro}}</td>
                                <td>{{$cil->nuit}}</td>
                                <td>{{$cil->bi}}</td>
                                <td>{{$cil->lficheiro}}</td>
                                <td>{{$cil->arquivo}}</td>
                                <td>{{$cil->tprovimento}}</td>
                                <td>{{$cil->status}}</td>
                                <td>{{$cil->observacao}}</td>
                                <td>{{$cil->npaginas}}</td>
                                <td>{{$cil->extrato}}</td>
                                <td>{{$cil->nib}}</td>
                                <td>{{$cil->dsalario}}</td>
                                <td>{{$cil->fsalario}}</td>
                                <td>{{$cil->outros}}</td>
                                <td>{{$cil->name}}</td>
                                <td>{{$cil->created_at}}</td>
                                <td>{{$cil->updated_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
  
</div>
</div>
</div>
</div>
          


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


<style>
/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 12px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
    top: 6.1px;
    left: 6px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
</style>
@stop


@stop


