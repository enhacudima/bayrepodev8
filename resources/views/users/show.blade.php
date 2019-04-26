@extends('adminlte::page')

@section('title', 'Bayport | This User')

@section('content_header')
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            <a class="btn btn btn-success" href="{{action('ListUserController@editpassword', $user->id)}}">
                <i class="fa fa-pencil fa-fw"></i> Reset Password
            </a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-snowflake-o"></i> Estado: </strong>
                @if( $user->status == 1)
                <td>Ativo</td>
                @else
                <td>Desativado</td>
                @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-user"></i> Name: </strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-envelope-open"></i> Email: </strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-phone"></i> Telefone: </strong>
            {{ $user->phone }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-user-secret"></i> User Name: </strong>
            {{ $user->username }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-map-marker"></i> City: </strong>
            {{ $user->city}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-map-marker"></i> Branch: </strong>
            {{ $user->branch }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-calendar"></i> Criado em: </strong>
            {{ $user->created_at }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong><i class="fa fa-fw fa-calendar"></i> Atualizado em: </strong>
            {{ $user->updated_at}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>

</div>

<div class="row">
    <div class="box-body table-responsive no-padding">   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title "> last Log Activity Lists</h4>
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


@section('js')


@stop

@section('css')

@stop


@stop


