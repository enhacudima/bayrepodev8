@extends('layouts.principal')

@section('content')




<style type="text/css">
    #level{

        height: calc(2.19rem + 10px);
    }
</style>


<div class="container">
@include('errors')

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(Auth::user()->level=='4')
                <div class="card-header">{{ __('Update User') }}  </div>
                <div class="card-header"> <a class="btn btn-primary" href="{{ route('listuser') }}"> Lista de Usuarios</a> </div>

                <div class="card-body">
                    <form method="post" action="{{action('ListUserController@update',$users->id)}}"" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <input hidden="" htype="" id="fk_user_id" name="fk_user_id" value="{{Auth::user()->id }}">

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$users->name}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$users->email}}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{$users->phone}}" >

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group row">
                            <label for="level"  class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                            <div class="col-md-6">
                                <select id="level" type="" class="form-control" name="level" value="{{$users->level}}" required >
                                    <option >Seleciona o nivel...</option>
                                                    @if(isset($nivel))

                                                        @foreach($nivel as $nivel)

                                                            <option value="{{$nivel->id}}">{{$nivel->discricao}}</option>

                                                        @endforeach

                                                    @endif    

                                </select> 

                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                               
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
                @else
                Erro: 450->Nao tens permissão
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
