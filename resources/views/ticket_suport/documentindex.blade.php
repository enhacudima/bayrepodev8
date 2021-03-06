@extends('adminlte::page')

@section('title', 'Bayport | Documents Management')

@section('content_header')
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Documents
        </h4>
            <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
             <a class="btn btn-success" href="{{ url('documentcreateticket') }}"> Create New Document</a>
        </div>
    </div>
</div>
    </div>

    <div class="panel-body ">



 <div class="box-body table-responsive no-padding">    



@if ($message = Session::get('success'))
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    <span class="sr-only">Close</span>
</button>
  <p>{{ $message }}</p>
</div>
@endif
            


<table id="tabela" class="table table-bordered ">
    <thead>
     <tr>
         <th>No</th>
         <th>Name</th>
         <th width="280px">Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach ($documents as $key => $cil)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $cil->name }}</td>
        <td>
            <a class="btn btn-info btn-xs" href="{{ url('document.show',$cil->id) }}">Show</a>
            <a class="btn btn-primary btn-xs" href="{{ url('document.edit',$cil->id) }}">Edit</a>  
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

{!! $documents->render() !!}

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
        $('#tabela').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 0, "asc" ]],
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


