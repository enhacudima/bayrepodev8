@extends('adminlte::page')

@section('title', 'Bayport | BlackList')

@section('content_header')
@stop

@section('content')
@include('blacklist.inc.messages')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Import AML List
        </h4>
            <div class="row">
    <div class="col-lg-12 margin-tb">

    </div>
</div>
    </div>

    <div class="panel-body ">

        <div class="box-body table-responsive no-padding"> 
        @can('blacklists-peps-uploud')
        

        {!!Form::open(['action'=>'PepsController@import','method'=>'POST','enctype'=>'multipart/form-data'])!!}

            Choose your xls/csv File : <input type="file" name="file" class="form-control">
         
            <input type="submit" class="btn btn-primary btn-sm" style="margin-top: 1%">

        {!! Form::close() !!}
        @endcan
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <table id="tabela" class="table-responsive table-bordered table-hover  table-sm" cellspacing="0" width="100%" style="font-size:9px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>UID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Aliases</th>
                    <th>Alternative Spelling</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Sub Category</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>DOB</th>
                    <th>DOBS</th>
                    <th>Place of Birth</th>
                    <th>Deceased</th>
                    <th>Passports</th>
                    <th>SSN</th>
                    <th>Identification Numbers</th>
                    <th>Locations</th>
                    <th>Countries</th>
                    <th>Citizenship</th>
                    <th>Companies</th>
                    <th>E/I</th>
                    <th>Linked To</th>
                    <th>Further Information</th>
                    <th>Keywords</th>
                    <th>External Sources</th>
                    <th>Entered</th>
                    <th>Updated</th>
                    <th>Editor</th>
                    <th>Age Date As Of Date</th>                    
                </tr>
            </thead>

            <tbody>
                
                    @foreach ($peps as $pep)
                <tr>                       
                            <td>{{$pep->id}}</td>
                            <td>{{$pep->uid}}</td>
                            <td>{{$pep->last_name}}</td>
                            <td>{{$pep->first_name}}</td>
                            <td>{{$pep->aliases}}</td>
                            <td>{{$pep->alternative_spelling}}</td>
                            <td>{{$pep->category}}</td>
                            <td>{{$pep->title}}</td>
                            <td>{{$pep->sub_category}}</td>
                            <td>{{$pep->position}}</td>
                            <td>{{$pep->age}}</td>
                            <td>{{$pep->dob}}</td>
                            <td>{{$pep->dobs}}</td>
                            <td>{{$pep->place_of_birth}}</td>
                            <td>{{$pep->deceased}}</td>
                            <td>{{$pep->passports}}</td>
                            <td>{{$pep->ssn}}</td>
                            <td>{{$pep->identification_numbers}}</td>
                            <td>{{$pep->locations}}</td>
                            <td>{{$pep->countries}}</td>
                            <td>{{$pep->citizenship}}</td>
                            <td>{{$pep->companies}}</td>
                            <td>{{$pep->e_i}}</td>
                            <td>{{$pep->linked_to}}</td>
                            <td>{{$pep->further_information}}</td>
                            <td>{{$pep->keywords}}</td>
                            <td>{{$pep->external_sources}}</td>
                            <td>{{$pep->entered}}</td>
                            <td>{{$pep->updated}}</td>
                            <td>{{$pep->editor}}</td>
                            <td>{{$pep->age_date_as_of_date}}</td>                    
                </tr>
                @endforeach
            </tbody>
    
        </table>
        <br>
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
            "order": [[ 1, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print','colvis',
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
