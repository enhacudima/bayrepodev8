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
                <div class="card-header">{{ __('Level User') }}  </div>

                <div class="card-body">
                    <form method="post" action="{{action('ListUserController@editleveluser',$nivel[0]->id)}}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Level on data base') }}</label>
                            <input hidden="" htype="" name="fk_user_id" id="fk_user_id" value="{{ Auth::user()->id }}">
                           

                            <div class="col-md-6">
                                <select id="id" type="" class="form-control" name="id" value="" style="height: calc(2.19rem + 10px);" >
                                    <option value=""></option>
                                                    @if(isset($nivel))

                                                        @foreach($nivel as $nivel)

                                                            <option value="{{$nivel->id}}">{{$nivel->discricao}}</option>

                                                        @endforeach

                                                    @endif                                   

                                </select>
                                @if ($errors->has('discricao'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('discricao') }}</strong>
                                    </span>
                                @endif 
                            </div> 
                        </div>        



                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                            <input hidden="" htype="" name="" value="{{ Auth::user()->id }}">

                            <div class="col-md-6">
                                <input id="discricao" type="text" class="form-control{{ $errors->has('discricao') ? ' is-invalid' : '' }}" name="discricao" value="" required autofocus>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                               
                                <button type="submit" class="btn btn-primary">
                                    {{ __('save') }}
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
