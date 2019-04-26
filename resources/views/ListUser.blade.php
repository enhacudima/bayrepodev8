@extends('layouts.principal')

@section('content')

 
<div class="container">
@include('errors')

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif
 
<div class="row">
 
<div class="panel panel-default">
 
<div class="panel-heading">
 
<h3>List User </h3>
 
</div>
 
<div class="panel-body">
 
<div class="form-group">
 
</div>
<table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>DATA DE CRIAÇÃO</th>
                <th>DATA DE ATUALIZAÇÃO</th>
                <th>NIVEL</th>
                <th>STATUS</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($users))
            @foreach($users as $cli)
            <tr>  
            <td>{{$cli->id}}</td>
            <td>{{$cli->name}}</td>
            <td>{{$cli->email}}</td>
            <td>{{$cli->created_at}}</td>
            <td>{{$cli->updated_at}}</td>        
            <td>{{$cli->discricao}}</td>
            @if( $cli->status == 1)

            <td>Ativo</td>
            @else
            <td>Desativado</td>
            @endif

            <td>
            <a class="btn btn btn-success" href="{{action('ListUserController@edituser', $cli->id)}}">
                <i class="fa fa-pencil fa-fw"></i> Edit
            </a>
            </td>
            <td>
            <a class="btn btn-danger" href="{{action('ListUserController@deleteuser', $cli->id)}}">
                <i class="fa fa-trash-o fa-lg"></i> Delete
            </a>
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
