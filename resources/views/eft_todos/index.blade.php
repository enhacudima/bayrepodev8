@extends('adminlte::page')

@section('title', 'Bayport | EFT Checks')

@section('content_header')
<h4>EFT Checks</h4>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@include('blacklist.inc.messages')
<!--/fim-->
        

        <div class="container">
                <h4 class="text-left">
                    Upload Eft List for NIB Verification
                </h4>       
        

        {!!Form::open(['action'=>'EftChecksController@upload','method'=>'POST','enctype'=>'multipart/form-data'])!!}

            Choose your xls/csv File : <input type="file" name="file" class="form-control">
         
            <input type="submit" class="btn btn-primary btn-sm" style="margin-top: 1%">

        {!! Form::close() !!}
        
        <br>
        <br>

        </div>

   
        <div class=container4 style="margin-left: 10%;margin-right: 10%">
        <table id="table" name="table" class="table-responsive table-bordered table-hover " cellspacing="0" width="100%" style="font-size:12px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identificador de Bulk</th>
                    <th>Uploaded at</th>
                    <th>User Name</th>
                    <th>Download</th>

                </tr>
            </thead>

            <tbody>
                
                @foreach ($eft->unique('identificador_de_bulk') as $check)
                <tr>                       
                    <td>{{$check->id}}</td>
                    <td>{{$check->identificador_de_bulk}}</td>
                    <td>{{$check->created_at}}</td>
                    <td>{{$check->name}} {{$check->lname}}</td>
                    <td><a href="{{url('')}}/eft/download/{{$check->identificador_de_bulk}}" class=""><i class="btn btn-info fa fa-download btn-bg" aria-hidden="true"></i></a></td>
                                              
                </tr>
                @endforeach
            </tbody>
    
        </table>
        
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
        $('#table').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 0, "desc" ]],
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