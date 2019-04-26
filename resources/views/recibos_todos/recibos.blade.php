@extends('adminlte::page')

@section('title', 'Bayport | Recibos')

@section('content_header')
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Recibos
        </h4>
    </div>

    <div class="panel-body ">



    <div class="box-body table-responsive no-padding">    
    <table id="reclatodas" class=" table dataTables_wrapper form-inline dt-bootstrap table-hover" >
                <thead>
            <tr>
               
                
                <th>Perido</th>
                <th>Branch</th>
                <th>Nome do Agente</th>
                <th>Consultant ID</th>
                <th>NIB</th>
                <th>Comissões</th> 
                <th>Awards</th>      
                <th>Data Correction</th>
                <th>Allowance Mobilizat</th>
                <th>Total de rendimentos</th>
                <th>IRPS</th>
                <th>Outras deduções</th>
                <th>Total de deduções</th>
                <th>Comissoes Liquido</th>
                <th>Awords Liquido</th>
                <th>Data correction Liquido</th>
                <th>Mobilizacao Liquido</th>
                <th>Total Liquido</th>
                <th>PDF</th>

            </tr>
        </thead>
        <tbody>
            @if(isset($recibo))
            @foreach($recibo as $cli)
            <tr> 
            <td>{{$cli->period}}</td>
            <td>{{$cli->branch}}</td>
            <td>{{$cli->agentName}}</td>
            <td>{{$cli->consultantId}}</td>
            <td>{{$cli->nibAgentWithout}}</td>
            <td>{{$cli->totalComission}}</td>
            <td>{{$cli->awards}}</td>
            <td>{{$cli->dataCorrection}}</td>
            <td>{{$cli->accomAllowanceMobilizat}}</td>
            <td>{{$cli->totaRendimento}}</td>
            <td>{{$cli->irps}}</td>
            <td>{{$cli->Outrasdeducoes}}</td>
            <td>{{$cli->totalDasDeducoes}}</td>
            <td>{{$cli->liquidoTotalComission}}</td>
            <td>{{$cli->liquidoAwords}}</td>
            <td>{{$cli->liquidoDataCorrections}}</td>
            <td>{{$cli->liquidoMobilizacao}}</td>
            <td>{{$cli->totalliquido}}</td>
            <td>
                <a class="fa fa-file-pdf-o" href="{{action('RecibosController@downloadPDF', $cli->id)}}"> PDF</a>
            </td>
            </tr>

             @endforeach
            @endif
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

@stop


@stop


