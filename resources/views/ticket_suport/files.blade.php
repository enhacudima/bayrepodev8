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
            <a class="btn btn-primary col-md-4" href="{{url($url)}}" style="width: 100%; margin-top: 10px"> Voltar ao passo 3</a>
           </div> 
        </div>   
<div class="container">



        <hr>
        <div class="">

                <div class="col-sm-12">
                        <div class="row"></div>
                        <div class="form-group">
                            <div class="box-body table-responsive no-padding">
                            <table class="table-responsive-sm table-condensed table  table-hover" cellspacing="0" width="100%" style="font-size:9">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo do Ficheiro</th>
                                    <th>Nome do Ficheiro</th>
                                    <th>Acção</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if(isset($product->productImg))
                                    @foreach($files as $key=>$cil)
                                    <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$cil->filetype}}</td>
                                    <td><strong><a class="fa fa-file " aria-hidden="true" href="{{asset('storage/productimg/'.$cil->filename)}}" target="_self"> {{$cil->filename}}</a></strong>
                                    </td>
                                    <th><strong><a class="fa fa-trash " aria-hidden="true" href="{{route('remove-anexo-form-a',$cil->filename)}}" target="_self"> Remover</a></strong>
                                    </th>
                                    </tr>
                                    @endforeach
                               @endif
                            </tbody>

                        </table>
                        </div>
                    </div>
                    </div>
                    <br>
      <form method="post" action="{{ url('/create-step-file',$product->productImg) }}" enctype="multipart/form-data">
          {{csrf_field()}}
        <h3>Upload<a style="color: red">*</a></h3>  
          <small id="fileHelp" class="form-text text-muted">Por favor carregue o anexo (jpeg,png,pdf) com os todos documentos. E não pode ser superior à 10MB</small>
          <div class="">
            <select class="form-control"   id="filetype[]"  name="filetype[]" required autofocus style="height: 100%" >
               <option disabled selected value>Seleciona...</option>
                        @foreach($file as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
            </select>
          </div>
        <div class="input-group control-group increment" >
          <input type="file" name="productimg[]" class="form-control" >
          <div class="input-group-btn" > 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus" ></i>Add</button>
          </div>
          
        </div>


        <div class="clone hide" >
        <div class="control-group">
          <div class="" style="margin-top:10px">
            <select class="form-control"   id="filetype[]"  name="filetype[]" required autofocus style="height: 100%" >
               <option disabled selected >Seleciona...</option>
                        @foreach($file as $cil)
                        <option value="{{$cil->id}}">
                            {{$cil->name}}
                        </option>
                         @endforeach
            </select>
          </div>
          <div class=" input-group" >
            <input type="file" name="productimg[]" class="form-control" >          
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remover</button>
            </div>
          </div>
        </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submeter</button>

        </form>
                </div>
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
