@extends('adminlte::page')

@section('title', 'Bayport | Branchs')

@section('content_header')
@stop

@section('content')
@include('blacklist.inc.messages')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Black List Search
        </h4>
            <div class="row">
    <div class="col-lg-12 margin-tb">

    </div>
</div>
    </div>

    <div class="panel-body ">


<div class="container">

    <div>
        <input type="text" name="search" id="search" class="form-control" placeholder="Search" title="Teste">
    </div>

    <br>
    <br>
    <br>

    <table class="table table-bordered table-hover  table-sm col-lg-6" id="tabela" cellspacing="0" width="100%" style="font-size:12px">
        <thead>
            <tr>
                <th>First Name</th>   
                <th>Surname</th>
                <th>Date of Birth</th>
                <th>Employee Number</th>
                <th>Date Black Listed</th>
            </tr> 
        </thead>

        <tbody>

        </tbody>
    </table>

</div>
</div>
</div>
</div>


@section('js')
<script>
    $(document).ready(function(){
        
        var jqxhr = {abort: function () {}};
        $('#search').keyup(function(){
            $value=$(this).val();
            if ($value=="") {
                $('#tabela >tbody >tr >td').html("Empty"); 
            }
            else
            {
                jqxhr.abort();
                jqxhr=$.ajax({
                type:'get',
                url:'{{url('')}}/search',
                data:{'search':$value},
                success:function(data){
                    //alert(data);
                    //console.log(data);
                    
                    if(!$.trim(data)){
                        $('#tabela >tbody >tr >td').html("Client not Black Listed"); 
                    }
                    else{
                        $('#tabela >tbody').html(data);
                    }
                   
                }
            })
            }
            
        })
 

    })
    
</script>
@stop
    
@stop