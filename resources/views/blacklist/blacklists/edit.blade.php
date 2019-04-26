@extends('adminlte::page')

@section('title', 'Bayport | BlackList')

@section('content_header')
@stop

@section('content')
@include('blacklist.inc.messages')

    <h2>EDIT</h2>
    <br>
    
    {!! Form::open(['action'=>['BlackListsController@update',$blacklist->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <div class="row">
        <div class="from-group col-lg-4">
            {{Form::label('reference','Reference')}}
            {{Form::text('reference',$blacklist->reference,['class'=>'form-control','placeholder'=>'Reference'])}}
        </div>

        <div class="from-group col-lg-4">
                {{Form::label('employee_number','Employee Number')}}<b style="color: red">*</b>
                {{Form::Number('employee_number',$blacklist->employee_number,['class'=>'form-control','placeholder'=>'Employee Number'])}}
        </div>

        <div class="from-group col-lg-4">
                {{Form::label('account_number','Account Number')}}<b style="color: red">*</b>
                {{Form::Number('account_number',$blacklist->account_number,['class'=>'form-control','placeholder'=>'Account Number'])}}
            </div>
        </div>
        <br>

        <div class="row">

            <div class="from-group col-lg-4">
            {{Form::label('mobile_number','Mobile Number')}}<b style="color: red">*</b>
            {{Form::Number('mobile_number',$blacklist->mobile_number,['class'=>'form-control','placeholder'=>'Mobile Number'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('world_check_reference','World Check Reference')}}
            {{Form::text('world_check_reference',$blacklist->world_check_reference,['class'=>'form-control','placeholder'=>'World Check Reference'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('id_number','ID Number')}}<b style="color: red">*</b>
            {{Form::text('id_number',$blacklist->id_number,['class'=>'form-control','placeholder'=>'ID Number'])}}
        </div>

        </div>
        
        <br>

        <div class="row">

            <div class="from-group col-lg-4">
            {{Form::label('first_name','First Names')}}
            {{Form::text('first_name',$blacklist->first_name,['class'=>'form-control','placeholder'=>'First Names'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('surname','Surname')}}
            {{Form::text('surname',$blacklist->surname,['class'=>'form-control','placeholder'=>'Surname'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('date_of_birth','Date of Birth')}}
            {{Form::Date('date_of_birth',$blacklist->date_of_birth,['class'=>'form-control','placeholder'=>'Date of Birth'])}}
        </div>

        </div>
        
        <br>

        <div class="row">

            <div class="from-group col-lg-4">
            {{Form::label('employer_type','Employer Type')}}
            {{Form::text('employer_type',$blacklist->employer_type,['class'=>'form-control','placeholder'=>'Employer Type'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('notes','Notes')}}
            {{Form::text('notes',$blacklist->notes,['class'=>'form-control','placeholder'=>'Notes'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('world_check_uid','World Check UID')}}
            {{Form::text('world_check_uid',$blacklist->world_check_uid,['class'=>'form-control','placeholder'=>'World Check UID'])}}
        </div>

        </div>
        
        <br>

        <div class="row">
            
            <div class="from-group col-lg-4">
            {{Form::label('category','Category')}}
            {{Form::text('category',$blacklist->category,['class'=>'form-control','placeholder'=>'Category'])}}
        </div>
        
        <div class="from-group col-lg-4">
            {{Form::label('title','Title')}}
            {{Form::text('title',$blacklist->title,['class'=>'form-control','placeholder'=>'Title'])}}
        </div>

        <div class="from-group col-lg-4">
            {{Form::label('sub_category','Sub-Category')}}
            {{Form::text('sub_category',$blacklist->sub_category,['class'=>'form-control','placeholder'=>'Sub-Category'])}}
        </div>
        </div>
        
        <br>

        <div class="row">

            <div class="from-group col-lg-4">
            {{Form::label('position','Position')}}
            {{Form::text('position',$blacklist->position,['class'=>'form-control','placeholder'=>'Position'])}}
        </div>

        <div class="from-group col-lg-8">
            {{Form::label('further_information_wc','Further Information WC')}}
            {{Form::text('further_information_wc',$blacklist->further_information_wc,['class'=>'form-control','placeholder'=>'Further Information WC'])}}
        </div>    

        </div>


        {{Form::hidden('_method','PUT')}}

        <br>
        
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    
    {!! Form::close() !!}

@stop