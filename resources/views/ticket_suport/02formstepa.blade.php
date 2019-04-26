@extends('adminlte::page')

@section('title', 'Bayport | New Ticket')

@section('content_header')
    <h1>Novo Ticket</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <div class="pull-right" style="margin-right: 10px">
            <div class="row">
                 <a class="btn btn-primary col-md-4" href="{{url('conselartickitet')}}" style="width: 100%"> Cancelar</a>
            </div>

           <div class="row">
            <a class="btn btn-primary col-md-4" href="{{ url()->previous() }}" style="width: 100%; margin-top: 10px"> Voltar</a>
           </div> 
        </div>   
<div class="container">

        
        
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{ url('newtticket') }}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Tipo de Cliente</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step complete "><!-- complete complete -->
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{url('form-ticket-a-back')}}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Formulario</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active"><!-- complete active -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Anexos</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Revisão e Submissão</div>
                </div>
            </div>

        <hr>
        <div class="">
          
          <td><strong><a class="fa fa-file " aria-hidden="true" href="{{url('anexosticket',$product->productImg)}}" target="_self"> Anexos</a></strong></td>
          

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif

        <form method="post" action="{{ url('/create-step-a2') }}" enctype="multipart/form-data">
          {{csrf_field()}}
        <h3>Upload<a style="color: red">*</a></h3>  
          <small id="fileHelp" class="form-text text-muted">Por favor carregue o anexo (jpeg,png,pdf) com os todos documentos. E não pode ser superior à 10MB</small>
          <div class="">
            <select class="form-control" value="{{{ $product->filetype or old('filetype') }}}"  id="filetype[]"  name="filetype[]" required autofocus style="height: 100%" {{ (!empty($product->productImg)) ? "disabled" : ''}}>
                <option disabled selected >Seleciona...</option>
                        @foreach($file as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
            </select>
          </div>
        <div class="input-group control-group increment" >
          <input type="file" name="productimg[]" class="form-control" {{ (!empty($product->productImg)) ? "disabled" : ''}}>
          <div class="input-group-btn" > 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus" {{ (!empty($product->productImg)) ? "disabled" : ''}}></i>Add</button>
          </div>
          
        </div>


        <div class="clone hide" >
        <div class="control-group">
          <div class="" style="margin-top:10px">
            <select class="form-control" value="{{{ old('filetype')?:$product->filetype  }}}"  id="filetype[]"  name="filetype[]" required autofocus style="height: 100%" {{ (!empty($product->productImg)) ? "disabled" : ''}}>
                <option disabled selected>Seleciona...</option>
                        @foreach($file as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
            </select>
          </div>
          <div class=" input-group" >
            <input type="file" name="productimg[]" class="form-control" {{ (!empty($product->productImg)) ? "disabled" : ''}}>          
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Rever detalhes</button>

        </form>

        </div> 

        
        
        
    </div>

@stop

@section('js')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $('.textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>

    <script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

  </script>

@stop

@section('css')



<style type="text/css">



<!--status progress-->
<style type="text/css">
.bs-wizard {margin-top: 40px;}

/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
/*END Form Wizard*/
</style>



@stop
