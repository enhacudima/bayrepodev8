@extends('adminlte::page')

@section('title', 'Bayport | QA Search Salario')

@section('content_header')
    <h1>QA</h1>
@stop

@section('content')
       <!-- Scripts vue -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <h2 style="text-align: center">Smart Search Salário</h2

    <hr>
        <div class="box-body table-responsive no-padding">   
        <div class="">
                          
                <div id="app">
                    <searchsal></searchsal>
                </div>
   
        </div>
    </div>
@stop

@section('css')

    
@stop
