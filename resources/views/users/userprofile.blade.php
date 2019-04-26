@extends('adminlte::page')

@section('title', 'Bayport | User Profile')

@section('content_header')
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Seu Perfil</h2>
        </div>
    </div>
</div>


<div class="container row">
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




@section('js')


@stop

@section('css')

@stop


@stop


