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
        <h4>Black List
        </h4>
            <div class="row">
    <div class="col-lg-12 margin-tb">

    </div>
</div>
    </div>

    <div class="panel-body ">



    <div class="box-body table-responsive no-padding">    


        
        <table id="tabela" class="table-responsive table-bordered table-hover  table-sm" cellspacing="0" width="100%" style="font-size:13px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date Blacklisted</th>
                    <th>Reference</th>
                    <th>Employee Number</th>
                    <th>Account Number</th>
                    <th>Mobile Number</th>
                    <th>World Check Reference</th>
                    <th>ID Number</th>
                    <th>First Names</th>
                    <th>Surname</th>
                    <th>Date of Birth</th>
                    <th>Employer Type</th>
                    <th>Notes</th>
                    <th>World Check UID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Sub-category</th>
                    <th>Position</th>
                    <th>Further Information (WC)</th>
                    <th>Updated at</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                    
                </tr>
            </thead>
            
            <tbody>
                
                    @foreach ($blacklists as $blacklist)
                <tr>                       
                            <td>{{$blacklist->id}}</td>
                            <td>{{$blacklist->created_at}}</td>
                            <td>{{$blacklist->reference}}</td>
                            <td>{{$blacklist->employee_number}}</td>
                            <td>{{$blacklist->account_number}}</td>
                            <td>{{$blacklist->mobile_number}}</td>
                            <td>{{$blacklist->world_check_reference}}</td>
                            <td>{{$blacklist->id_number}}</td>
                            <td>{{$blacklist->first_name}}</td>
                            <td>{{$blacklist->surname}}</td>
                            <td>{{$blacklist->date_of_birth}}</td>
                            <td>{{$blacklist->employer_type}}</td>
                            <td>{{$blacklist->notes}}</td>
                            <td>{{$blacklist->world_check_uid}}</td>
                            <td>{{$blacklist->category}}</td>
                            <td>{{$blacklist->title}}</td>
                            <td>{{$blacklist->sub_category}}</td>
                            <td>{{$blacklist->position}}</td>
                            <td>{{$blacklist->further_information_wc}}</td>
                            <td>{{$blacklist->updated_at}}</td>
                            <td><a href="{{url('')}}/blacklists/{{$blacklist->id}}/edit" class="" href=""><i class="btn btn-warning fa fa-pencil btn-sm" aria-hidden="true"></i></a></td>
                            <td>
                                    {!!Form::open(['action'=>['BlackListsController@destroy',$blacklist->id],'method'=>'POST', 'class'=>'pull-right'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::button('<i class ="fa fa-trash"></i>',['type'=>'submit','class'=>'btn btn-danger btn-sm'])}}
                        
                                {!!Form::close()!!}
                            </td>                            
                    
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
