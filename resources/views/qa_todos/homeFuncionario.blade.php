@extends('adminlte::page')

@section('title', 'Bayport | QA Smart Search')

@section('content_header')
    <h1>QA</h1>
@stop

@section('content')
           <!-- Scripts vue -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <h2 style="text-align: center">Smart Search Info</h2>


    <hr>
     <div class="box-body table-responsive no-padding">   
        <div class="">
                          
                <div id="app">
                    <search></search>
                </div>
   
        </div>
     </div>   
@stop

@section('css')
    
@stop
