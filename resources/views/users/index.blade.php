@extends('adminlte::page')

@section('title', 'Bayport | Users Management')

@section('content_header')
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Users Management
        </h4>
            <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
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
        <th scope="col"><i class="fa fa-fw fa-user"></i> Nome</th>
        <th scope="col"><i class="fa fa-fw fa-envelope-open"></i> Email</th>
        <th>PHONE</th>
        <th scope="col"><i class="fa fa-fw fa-calendar"></i> Data de criação </th>
        <th scope="col"><i class="fa fa-fw fa-calendar"></i> Data da ultima atualização </th>
        <th scope="col"><i class="fa fa-fw fa-snowflake-o"></i> Estado</th>
        <th>Roles</th>
        <th width="280px"> <i class="fa fa-fw fa-gears">Action</th>
     </tr>
    </thead>
    <tbody>
       @foreach ($data as $key => $user)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }} {{ $user->lname }}</td>
        <td class="text-primary">{{ $user->email }}</td>
        <td>{{$user->phone}}</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td>  
        @if( $user->status == 1)
        <td>Ativo</td>
        @else
        <td>Desativado</td>
        @endif
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge badge-success">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        <td>
           <a class="btn btn-info btn-xs" href="{{ route('users.show',$user->id) }}">Show</a>
           <a class="btn btn-primary btn-xs" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @if( $user->status == 1)
            <a class="btn btn-danger btn-xs" href="{{action('ListUserController@deleteuser', $user->id)}}">
                <i class="fa fa-trash-o fa-lg"></i> Delete
            </a>
            @else
            <a class="btn  btn-primary btn-xs" href="{{action('ListUserController@activeuser', $user->id)}}">
                <i class="fa fa-refresh fa-spin fa-fw"></i> Active
               
            </a>
            @endif
        </td>
      </tr>
     @endforeach
    </tbody>
</table>

{!! $data->render() !!}

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


