@extends('layouts.principal')

@section('content')




<!--coloque o seu conteudo aqui-->

 
<div class="row">
 
<div class="panel panel-default">
 
<div class="panel-heading">
 
<h3>Recibos </h3>
 
</div>
 
<div class="panel-body">
 
<div class="form-group">
 
</div>
<table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
               
                
                <th>Perid</th>
                <th>Nome do Agente</th>
                <th>Consultant ID</th>
                <th>NIB</th>
                <th>Data Correction</th>
                <th>Total Comission</th>
                <th>Awards</th>                
                <th>Accom Allowance Mobilizat</th>
                <th>Total de rendimentos</th> 
                <th>IRPS</th>
                <th>Outras deduções</th>
                <th>Total de deducoes</th>
                <th>Branch</th>                
                <th>Comissoes Liquido</th>
                <th>Awords Liquido</th>
                <th>Mobilizacao Liquido</th>
                <th>PDF</th>

            </tr>
        </thead>
        <tbody>
            @if(isset($recibo))
            @foreach($recibo as $cli)
            <tr> 
            <td>{{$cli->period}}</td>
            <td>{{$cli->agentName}}</td>
            <td>{{$cli->consultantId}}</td>
            <td>{{$cli->nibAgentWithout}}</td>
            <td>{{$cli->dataCorrection}}</td>
            <td>{{$cli->totalComission}}</td>
            <td>{{$cli->awards}}</td>
            <td>{{$cli->accomAllowanceMobilizat}}</td>
            <td>{{$cli->totaRendimento}}</td>
            <td>{{$cli->irps}}</td>
            <td>{{$cli->Outrasdeducoes}}</td>
            <td>{{$cli->totalDasDeducoes}}</td>
            <td>{{$cli->branch}}</td>
            <td>{{$cli->liquidoTotalComission}}</td>
            <td>{{$cli->liquidoAwords}}</td>
            <td>{{$cli->liquidoMobilizacao}}</td>
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
 




 
<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>


<script>

    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print','colvis'
        ]
    } );
} );

</script>



@endsection