@extends('layouts.principal')

@section('content')

<style type="text/css">
	body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 340px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}


</style>


    <div id="login">
        <h3 class="text-center text-white pt-5"></h3>
        <div class="container">

        <div id="alert" name="alert"  class="alert alert-success text-center hidden">

       

        </div>       	






            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">





                        <form id="login-form" class="form" action="" method="get" href="" aria-label="">
                            <h3 class="text-center text-info">Seleciona os Filtros </h3>


                            <div class="form-group">
                                <label for="username" class="text-info">Provincia:</label><br>
                                <select id="province" type="" class="form-control" name="province" value="{{ old('province') }}" style="height: calc(2.19rem + 10px);" required >
                                    <option value="">Seleciona a provincia ...</option>

                                                    @if(isset($provincia))

                                                        @foreach($provincia as $provincia)

                                                            <option value="{{$provincia->province_id}}">{{$provincia->name}}</option>

                                                        @endforeach

                                                    @endif                                   

                                </select> 

                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Agencia:</label><br>
                                <select id="agencia" type="" class="form-control" name="agencia" value="{{ old('agencia') }}" style="height: calc(2.19rem + 10px);" required >
                                    <option id="agencias" name="agencias"value="" >Seleciona a Agencia ...</option>


                                         

                                </select>

                                <table class="table table-bordered table-hover" id="example" style="width:100%">
 


                            </div>
                             <div class="form-group">
                                <label for="password" class="text-info">Periodo:</label><br>
                                <select id="periodo" type="" class="form-control" name="periodo" value="{{ old('periodo') }}"  style="height: calc(2.19rem + 10px);"required >
                                    <option value="" >Seleciona o Periodo ... </option>

                                                    @if(isset($recibo))

                                                        @foreach($recibo as $periodos)

                                                            <option value="{{$periodos->period}}">{{$periodos->period}}</option>

                                                        @endforeach

                                                    @endif  
         

                                </select>


						</form>
                            </div>
                            <div class="form-group" ">
                                 <a id="submits"   name="submits" class="btn btn-info btn-md fa" va>submit</a> 
                                 <a id="pdf"   name="pdf" class="btn btn-info btn-md fa fa-file-pdf-o" va> PDF</a> 
                            </div>

                         
                    </div>
                </div>
            </div>
        </div>
    </div>




<script>
    
$(document).ready(function(){

	$('#submits').click(function(){
   // get all the inputs into an array.

    var $inputs = $('select');

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var value = {};
    $inputs.each(function() {
        value[this.name] = $(this).val();
    });

   	var value1=value['agencia'];
   	var value2=value['periodo'];

	if (value1==="" || value2==="") {

	$('.alert').show('fast');	
    $('.alert:even').removeClass('hidden');
    $('.alert:even').removeClass('alert-success');
    $('.alert').last().addClass('alert-danger');
    $('.alert').html('Complente os Campos!');
    setTimeout(function() {
    $('.alert').fadeOut('slow');
	}, 2000); // <-- time in milliseconds


	}else{ 

   	var url = '{{action('RecibosController@index', ':value1')}}';

	url = url.replace(':value1', value1+'/'+value2 );
	
   	window.location.href =url;

   	};

	console.log(value);
	


	});	


	$('#pdf').click(function(){
   // get all the inputs into an array.

    var $inputs = $('select');

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var value = {};
    $inputs.each(function() {
        value[this.name] = $(this).val();
    });

   	var value1=value['agencia'];
   	var value2=value['periodo'];

	if (value1==="" || value2==="") {

	$('.alert').show('fast');	
    $('.alert:even').removeClass('hidden');
    $('.alert:even').removeClass('alert-success');
    $('.alert').last().addClass('alert-danger');
    $('.alert').html('Complente os Campos!');
    setTimeout(function() {
    $('.alert').fadeOut('slow');
	}, 2000); // <-- time in milliseconds


	}else{ 

   	var url = '{{action('RecibosController@grupdownloadPDF', ':value1')}}';

	url = url.replace(':value1', value1+'/'+value2 );
	
   	//return uma simples leitura na pagina da url indicada
 	 window.location.href = url;


   	};

	console.log(url);
	


	});





	  $('#province').change (function(){

    	
    	$value=$(this).val();
    	//alert($value);
    	$.ajax({
		type : 'get',
 
        url : '{{URL::to('search')}}',
 
        data:{'search':$value},
 
        success:function(data){
 	

 		
 		//alert(data)
        $('select[name="agencia"]').html(data);

    		
    		}


   	})			
      

 
    });

});



$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>


<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>


@endsection