@extends('adminlte::page')

@section('title', 'Bayport | Agents')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li role="presentation" class="">
                <a href="{{ url('myticket') }}">Active Tickets
                    <span class="badge">
                         {{$acteticket}}                    </span>
                </a>
            </li>
            <li role="presentation" class="">
                <a href="{{ url('completticket') }}">Completed Tickets
                    <span class="badge">
                        {{$completticket}}                   </span>
                </a>
            </li>
                @if(Auth::user()->ticket_level=='1')
                <li role="presentation" class="">
                    <a href="http://ticketit.kordy.info/tickets-admin">Dashboard</a>
                </li>

                <li role="presentation" class="dropdown active">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Settings 
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" class="active">
                            <a href="">Agents</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="{{url('/categories')}}">Categories</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="{{url('/teams')}}">Teams</a>
                        </li>
                    </ul>
                </li>
                @endif
        </ul>
    </div>
</div>

            <div>
            <!--Mensagens-->
            @include('messages')
            <!-- /Mensagens-->
            </div>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Category List
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">      
    <table class="dataTables_wrapper form-inline dt-bootstrap table-hover  table-striped" cellspacing="0" width="100%" id="usersteble">
        <thead >
        <tr>
            
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Team</th>
            <th scope="col">Notification</th>
            <th scope="col">Action</th>
            <th scope="col">Last update</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>{{$cil->name}}</td> 
             <td>{{$cil->lname}}</td>
             <td>{{$cil->ticket_level}}</td>
             <td>{{$cil->ticket_notification}}</td>
                <td>
                    <form method="POST" action="{{url('/addlevel')}}" accept-charset="UTF-8" autocomplete="Active">
                        {{ csrf_field() }}
                        <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}">
                        <input   name="id" type="hidden" id="id" value="{{$cil->id}}">

                          <div class="col-lg-12">
                            <div class="row"> 
                            <div class="col-lg-6">
                               <select class="form-control" value="{{{ old('ticket_level')?:isset($ticket_level->ticket_level)}}}"  id="ticket_level"  name="ticket_level"  autofocus style="height: auto;width: 100%">
                                    <option disabled selected>Team..</option>
                                    <option value="">No team</option>
                                     @foreach($teams as $cils)
                                    <option value="{{$cils->id}}">
                                        {{$cils->name}}
                                    </option>
                                     @endforeach
                                     
                                </select>
                            </div> 
                            <div class="col-lg-3">
                               <select class="form-control" value="{{{ old('ticket_notification')?:isset($ticket_level->ticket_notification)}}}"  id="ticket_notification"  name="ticket_notification" autofocus style="height: auto;width: 100%">
                                    <option disabled selected>Send Notification..</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                     
                                </select>
                            </div>

                            <div class="col-lg-3">
                            <input class="btn btn-info btn-sm" type="submit" value="Join">
                            </div>

                            </div>

                          </div>

                    </form>
                </td>
            
             <td>{{$cil->updated_at->diffForHumans()}}</td>
            </tr>
        @endforeach    
        </tbody>
    </table>
        </div>
    </div>
</div>
</div>



    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>





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
        $('#usersteble').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            
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


