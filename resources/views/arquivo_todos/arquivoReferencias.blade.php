@extends('adminlte::page')

@section('title', 'Bayport | Referências')

@section('content_header')
    <h1>Arquivo Master</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="alert alert-danger print-error-msg" style="display:none;text-align: center">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none;text-align: center">
    </div>

    <h2 style="text-align: center">Arquivo Referências</h2>


    <hr>



    <!-- Corpo principal!!!!-->
        <div class="col-md-12">



            <div class="col-md-6">
                <h4 >Detalhes do cliente</h4>


                            <div class="form-group" style="width: 400px">
                                <label for="title">Loan ID</label>
                                <p class="name">
                                <strong>
                                <input type="number" value="{{{isset($product->loanid) or '' }}}"  id="inputs"  name="inputs" placeholder="Pesquisar por loan ID..."style="width: 300px" required autofocus>
                                </strong>
                                </p>

                            </div>
                            <div>
                              <strong>
                              <button type="submit" class="btnEmidio btn btn-primary bord0" value="-1" id="next"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Anterior</button>
                              </strong>
                              <strong>
                              <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="next">Proximo <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                              </strong>
                            </div>

                            <div>
                                <table class="table" id="details" name="details" border="0">
                                  <tbody>
                                  </tbody>
                                </table>

                            </div>


            </div>

    <!-- Corpo principal!!!!-->

            <div class="col-md-6">


                            <h4>Formulario</h4>
            <form id="myForm" name="myForm" action="{{url('/arquivoreferencia')}}" method="post">
                                @csrf
                                {{ csrf_field() }}


                        <div class="row ">
                            <div class="form-group col-sm-4">
                                <label >Numero do formulario</label>
                                <p class="name">
                                    <strong>
                                    <input type="text" tyle="width: 100%"  id="nform"  name="nform" style="color: #c53131;"  required autofocus>
                                    </strong>
                                </p>

                            </div>

                            <div class="form-group  col-sm-7 col-sm-offset-1">
                                <label >Referência</label>
                                <p class="name">
                                    <strong>
                                    <input type="text" tyle="width: 100%"  id="referencia"  name="referencia" style="color: #000000;" disabled>
                                    </strong>
                                </p>

                            </div>
                      </div>

            <div class="">
                        <p class="submit col">
                          <strong>
                          <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gerar Referência</button>
                          </strong>
                        </p>

                        </div>

                        <br>
                        <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
                        <input hidden="" htype="" name="loanid" id="loanid" value="">
            </div>

            </form>

        </div>

@section('js')

   <script>

            var jqxhr = {abort: function () {}};

            $(document).ready(function(){

                $('#inputs').keydown(function(){

                    $value=$(this).val();
                    $('#loanid').val($value);
                    //alert(('#loanid').val());
                    $max=$value.length

                    if(7>$max){

                        //alert($max);

                        $('#inputs').css("background-color", "pink");

                    }else{

                        $('#inputs').css("background-color", "#FAFFBD");

                        jqxhr.abort();

                        jqxhr =$.ajax({

                            type : 'get',

                            url : '{{URL::to('arquivosearchinformation')}}',

                            data:{'arquivosearchinformation':$value},

                            success:function(data){

                                $('#details > tbody') .html(data);

                                //alert(data);
                                //pesquisando dados do formulario
                                $.ajax({

                                      type : 'get',

                                      url : '{{URL::to('arquivosearchformulario')}}',

                                      data:{'arquivosearchformulario':$value},

                                      success:function(data){

                                          //alert(data);
                                          console.log(data);
                                          $.each( data, function( key, value ) {
                                            if (!$.trim(value)){//aquivamos verficar se existe dados no data para evitar qualquer erro

                                                $('#nform').val('');
                                                $('#apoliceseguro').val('');
                                                $('#nuit').val('');
                                                $('#bi').val('');
                                                $('#lficheiro').val('');
                                                $('#fsalario').val('');
                                                $('#arquivo').val('');
                                                $('#tprovimento').val('');
                                                $('#status').val('');
                                                $('#observacao').val('');
                                                $('#npaginas').val('');
                                                $('#extrato').val('');
                                                $('#nib').val('');
                                                $('#dsalario').val('');
                                                $('#outros').val('');
                                                $('#referencia').val('');
                                            }else {
                                              $('#nform').val(value.nform);
                                              $('#apoliceseguro').val(value.apoliceseguro);
                                              $('#nuit').val(value.nuit);
                                              $('#bi').val(value.bi);
                                              $('#lficheiro').val(value.lficheiro);
                                              $('#fsalario').val(value.fsalario);
                                              $('#arquivo').val(value.arquivo);
                                              $('#tprovimento').val(value.tprovimento);
                                              $('#status').val(value.status);
                                              $('#observacao').val(value.observacao);
                                              $('#npaginas').val(value.npaginas);
                                              $('#extrato').val(value.extrato);
                                              $('#nib').val(value.nib);
                                              $('#dsalario').val(value.dsalario);
                                              $('#outros').val(value.outros);
                                              $('#referencia').val(value.referencia);
                                              }
                                          })


                                      }

                                  });
                            }

                        });

                    };
                });
            });

        </script>


                <!-- next -->
                <script>
                    var jqxhr = {abort: function () {}};

                   $(document).on('click', 'button[id=next]',(function() {//using delegaction to send event on dynamic datatable


                            $value1=($('#inputs').val());
                            $value2=($(this).val());
                            $loanid=parseFloat($value1)+parseFloat($value2);
                            loanid=parseFloat($value1)+parseFloat($value2);
                            $('#inputs').val($loanid);
                            $('#loanid').val($loanid);
                            //alert($loanid);
                            $max=$loanid.length

                            if(7>$max){

                                //alert($max);

                                $('#inputs').css("background-color", "pink");

                            }else{

                                $('#inputs').css("background-color", "#FAFFBD");

                                jqxhr.abort();

                                jqxhr =$.ajax({

                                    type : 'get',

                                    url : '{{URL::to('arquivosearchinformation')}}',

                                    data:{'arquivosearchinformation':$loanid},

                                    success:function(data){

                                        $('#details > tbody') .html(data);

                                        //alert(data);
                                        //pesquisando dados do formulario
                                        $.ajax({

                                              type : 'get',

                                              url : '{{URL::to('arquivosearchformulario')}}',

                                              data:{'arquivosearchformulario':loanid},

                                              success:function(data){
                                                  console.log(data);
                                                  $.each( data, function( key, value ) {
                                                    if (!$.trim(value)){//aquivamos verficar se existe dados no data para evitar qualquer erro

                                                        $('#nform').val('');
                                                        $('#apoliceseguro').val('');
                                                        $('#nuit').val('');
                                                        $('#bi').val('');
                                                        $('#lficheiro').val('');
                                                        $('#fsalario').val('');
                                                        $('#arquivo').val('');
                                                        $('#tprovimento').val('');
                                                        $('#status').val('');
                                                        $('#observacao').val('');
                                                        $('#npaginas').val('');
                                                        $('#extrato').val('');
                                                        $('#nib').val('');
                                                        $('#dsalario').val('');
                                                        $('#outros').val('');
                                                        $('#referencia').val('');
                                                    }else {
                                                      $('#nform').val(value.nform);
                                                      $('#apoliceseguro').val(value.apoliceseguro);
                                                      $('#nuit').val(value.nuit);
                                                      $('#bi').val(value.bi);
                                                      $('#lficheiro').val(value.lficheiro);
                                                      $('#fsalario').val(value.fsalario);
                                                      $('#arquivo').val(value.arquivo);
                                                      $('#tprovimento').val(value.tprovimento);
                                                      $('#status').val(value.status);
                                                      $('#observacao').val(value.observacao);
                                                      $('#npaginas').val(value.npaginas);
                                                      $('#extrato').val(value.extrato);
                                                      $('#nib').val(value.nib);
                                                      $('#dsalario').val(value.dsalario);
                                                      $('#outros').val(value.outros);
                                                      $('#referencia').val(value.referencia);
                                                      }

                                                  });

                                                }


                                          });

                                    }


                                });

                            };


                          }));



                </script>
            <!--gravando dados na base de dados-->
            <script>
            $("#myForm").on("submit",function (e)
                {
                    e.preventDefault();
                    var _token = $("input[name='_token']").val(); // get csrf field.
                    var loanid = $("input[name='loanid']").val();
                    var nform = $("input[name='nform']").val();
                    var apoliceseguro = "0";
                    var nuit = "0";
                    var bi = "0";
                    var lficheiro ="0";
                    var fsalario = "0";
                    var arquivo = "0";
                    var tprovimento = "0";
                    var status = "copy";
                    var observacao = "0";
                    var npaginas = "0";
                    var idusuario = $("input[name='idusuario']").val();
                    var extrato = "0";
                    var nib = "0";
                    var dsalario = "0";
                    var outros = "0";


            $.ajax({
              url: "{{URL('arquivoreferencia')}}",
              type:'POST',
              data: {_token:_token, loanid:loanid,nform:nform,apoliceseguro:apoliceseguro,nuit:nuit,bi:bi,lficheiro:lficheiro,fsalario:fsalario,arquivo:arquivo,tprovimento:tprovimento,status:status,observacao:observacao,npaginas:npaginas,idusuario:idusuario,extrato:extrato,nib:nib,dsalario:dsalario,outros:outros},
              success: function(data) {
                // No error empty the field and previous error msg if any.
                if($.isEmptyObject(data.error)){
                  $(".print-success-msg").html('');
                  $(".print-success-msg").css('display','block');
                  //$(".print-success-msg").html("Arquivo Salvo com sucesso");

                  $('#loanid').val('');
                  $('#nform').val('');
                  $('#apoliceseguro').val('');
                  $('#nuit').val('');
                  $('#bi').val('');
                  $('#lficheiro').val('');
                  $('#fsalario').val('');
                  $('#arquivo').val('');
                  $('#tprovimento').val('');
                  $('#status').val('');
                  $('#observacao').val('');
                  $('#npaginas').val('');
                  $('#extrato').val('');
                  $('#nib').val('');
                  $('#dsalario').val('');
                  $('#outros').val('');
                  $('#referencia').val('');


                  $(".print-success-msg").html(data.success).fadeTo(4000, 500).slideUp(500, function(){
                      $(".print-success-msg").html(data.success).slideUp(1000);
                  });

                }else{
                  errorMsg(data.error);
                }

              },
              error: function(data){
            var errors = data.responseJSON;          
            $.ajax({

                type : 'get',

                url : '{{URL::to('arquivosearchnfom')}}',

                data:{'arquivosearchnfom':nform},

                success:function(data){

                console.log(data);
                $.each( data, function( key, value ) {
                 if ($.trim(value)){
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');

                $(".print-error-msg").html("Alerta: Este Número de formulario já existe na referencia:"+value.referencia+" loanid:"+value.loanid).fadeTo(10000, 500).slideUp(500, function(){
                    $(".print-error-msg").html("Alerta: Este Número de formulario já existe na referencia:"+value.referencia+" loanid:"+value.loanid).slideUp(10000);
                })}else {

            errorMsg(errors.errors);//usamos o errors oara ter o objecto do json
            // Render the errors with js ...
                }})}})//and ajax nfm


          }

                    });

                    // Function to show error messages
              function errorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

                $(".print-error-msg").fadeTo(4000, 500).slideUp(500, function(){
                    $(".print-error-msg").slideUp(1000);
                });



              });
              }

                });



            </script>




        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
@stop

@section('css')

  <style>


        h2 {
            margin-bottom: 20px;
            color: #474E69;
            font-family:'Nunito', sans-serif;
        }

        h4 {
            font-family:'Nunito', sans-serif;;
        }
        /* ===========================
           ====== Contact Form =======
           =========================== */

        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 200px;
            color: #6d6a6a;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

        textarea {
            width: 100%;
            height: 400px;
            max-width: 100%;
            line-height: 18px;

        }

        input:hover, textarea:hover,
        input:focus, textarea:focus {
            border-color: 1px solid #C9C9C9;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
        }

        .form label {
            margin-left: 10px;
            color: #6d6a6a;
        }

        /* ===========================
           ====== Submit Button ======
           =========================== */

        .submit input {
            width: 100%;
            height: 40px;
            background-color: #474E69;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            max-width: 100%;
        }

        select{
            font-family:'Nunito', sans-serif;
            font-size: 17px;
            box-shadow:rgba(0, 0, 0, 0.1) 0px 0px 8px ;
            color: #6d6a6a;
            border: 1px solid #E5E5E5;
            width: 200px;
            height: 41px;
        }

        #observacao{
            resize: horizontal;
            width: 1200px;
            height: 80px;

        }

        .bord0 {
        border-radius: 0;
        }

    </style>

    <style>
    .container-fluid{

        padding-left: 0px;

        margin-left: 0px;
    }
    </style>
@stop


@stop


