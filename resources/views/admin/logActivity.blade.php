@extends('adminlte::page')

@section('title', 'Bayport | Dashboard')

@section('content_header')
    
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="box-body table-responsive no-padding">   
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title "> Log Activity Lists</h4>
                  <p class="card-category"> Activity</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="example">
                      <thead class=" text-primary">
                        <th>#</th>
                        <th>Subject</th>
                        <th>URL</th>
                        <th>Method</th>
                        <th>Ip</th>
                        <th width="300px">User Agent</th>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>User Last Name</th>
                        <th>User level</th>
                        <th>Created_at</th>
                        <th>Last_update</th>
                      </thead>
                      <tbody>
                        @if($logs->count())
                            @foreach($logs as $key => $log)
                            <tr>
                                <td>{{$log->id}}</td>
                                <td>{{ $log->subject }}</td>
                                <td class="text-success">{{ $log->url }}</td>
                                <td><label class=" btn label label-info">{{ $log->method }}</label></td>
                                <td class="text-warning">{{ $log->ip }}</td>
                                <td class="text-danger">{{ $log->agent }}</td>
                                <td>{{ $log->user_id }}</td>
                                <td>{{$log->name}}</td>
                                <td>{{$log->lname}}</td>
                                <td>{{$log->level}}</td>
                                <td>{{$log->created_at}}</td>
                                <td>{{$log->updated_at->diffForHumans()}}</td>
                            </tr>
                            @endforeach
                        @endif
                       
                      </tbody>
                    </table>
                   </div>
                </div>
              </div>
              {{ $logs->links() }}
            </div>
          </div>
        </div>
      </div>
 </div>     



@stop
@section('js')

@stop

@section('css')

@stop
