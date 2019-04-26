@extends('adminlte::page')

@section('title', 'Bayport | Arquivo Master')

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


    <hr>



    <!-- Corpo principal!!!!-->
        <div class="row content ">



            <div class="col-lg-4">
                <h4 >Detalhes do cliente</h4>


                            <div class="form-group" style="width: 100%;">
                                <strong>
                                <label for="title">Loan ID</label>
                                </strong>
                                <strong>  
                                <input class="form-control"  type="number" value="{{{ isset($product->loanid) or '' }}}"  id="inputs" autocomplete="true" name="inputs" placeholder="Pesquisar por loan ID..."style="width: 52%" required autofocus>
                                </strong>
                            
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3">
                              <strong>
                              <button type="submit" tyle="width: 100%" class="btnEmidio btn btn-primary bord0" value="-1" id="next"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Anterior</button>
                              </strong>
                              </div>
                              <div class="form-group col-md-4 col-md-offset-1">
                              <strong>
                              <button type="submit" tyle="width: 100%" class="btnEmidio btn btn-primary bord0" value="1" id="next">Proximo <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                              </strong>
                              </div>
                            

                                <table class="table table-hover" id="details" name="details" border="0">
                                  <tbody>
                                  </tbody>
                                </table>

                             </div>   

                          


            </div>

    <!-- Corpo principal!!!!-->

            <div class="form-group  col-lg-8 row">

                          <h4>Formulario</h4>
                            <div class="row">
                            <div class="form-group col-md-4">
                                <label >Referência</label>
                                
                                    <strong>
                                    <input class="form-control" type="text" tyle="width: 100%"  id="referencia"  name="referencia" style="color: #000000;width: 100%" disabled>
                                    </strong>
                              
                            </div>

                            <div class="form-group col-md-8">
                                <label >Usuario</label>
                                    <strong>
                                    <input class="form-control"  type="text" tyle="width: 100%"  id="usuario"  name="usuario" style="color: #000000;width: 100%" disabled>
                                    </strong>

                            </div>
                          </div>
                     
            <form role="form" id="myForm" name="myForm" action="{{url('/arquivogravar')}}" method="post">
                                @csrf
                                {{ csrf_field() }}
                        <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
                        <input hidden="" htype="" name="loanid" id="loanid" value="">            

                    <div class="row">
                            <div class="form-group col-md-4 ">
                                <label >Numero do formulario</label>
                                  <strong>
                                    <input class="form-control"  type="text" tyle="width: 100%"  id="nform"  name="nform" style="color: #c53131;" required autofocus>
                                  </strong>  
                                

                            </div>



                        <div class="form-group  col-md-4">
                              <label>Nuit:</label>
                                  <select  class="form-control"   id="nuit"  name="nuit" required autofocus>
                                      <option disabled selected value></option>
                                      <option value="Yes">
                                          Yes
                                      </option>
                                      <option value="No">
                                          NO
                                      </option>
                                      <option value="No original">
                                          No original
                                      </option>



                                  </select>

                        </div>

                            <div class="form-group  col-md-4">
                              <label>BI:</label>
                                  <select  class="form-control"   id="bi"  name="bi" required autofocus>
                                      <option disabled selected value></option>
                                      <option value="Yes">
                                          Yes
                                      </option>
                                      <option value="No">
                                          NO
                                      </option>
                                      <option value="No original">
                                          No original
                                      </option>



                                  </select>

                            </div>

                     </div>


                        <div class="row">
                            <div class="form-group  col-md-4">
                              <label>Extrato Bancário:</label>
                                  <select   class="form-control"  id="extrato"  name="extrato" required autofocus>
                                      <option disabled selected value></option>
                                      <option value="Yes">
                                          Yes
                                      </option>
                                      <option value="No">
                                          NO
                                      </option>
                                      <option value="No original">
                                          No original
                                      </option>



                                  </select>

                            </div>

                            <div class="form-group  col-md-4">
                                <label>NIB:</label>
                                    <select class="form-control"   id="nib"  name="nib" required autofocus>
                                        <option disabled selected value></option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                        <option value="No">
                                            NO
                                        </option>
                                        <option value="No original">
                                            No original
                                        </option>



                                    </select>
                                
                            </div>

                            <div class="form-group  col-md-4">
                                <label>Declaracao de Salario:</label>
                                    <select class="form-control"    id="dsalario"  name="dsalario" required autofocus>
                                        <option disabled selected value></option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                        <option value="No">
                                            NO
                                        </option>
                                        <option value="No original">
                                            No original
                                        </option>



                                    </select>

                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group  col-md-4">
                                <label>Folha de Salário/Paralelo:</label>
                                    <select  class="form-control"   id="fsalario"  name="fsalario" required autofocus>
                                        <option disabled selected value></option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                        <option value="No">
                                            NO
                                        </option>
                                        <option value="No original">
                                            No original
                                        </option>
                                    </select>
                            </div>

                            <div class="form-group  col-md-4">
                                <label>Titulo de Provimento:</label>
                                    <select  class="form-control"   id="tprovimento"  name="tprovimento" required autofocus>
                                        <option disabled selected value></option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                        <option value="No">
                                            NO
                                        </option>
                                        <option value="No original">
                                            No original
                                        </option>



                                    </select>
                            </div>
                          
                            <div class="form-group  col-md-4">
                            <label>Apolice de Seguro:</label>
                                <select class="form-control"   id="apoliceseguro"  name="apoliceseguro" required autofocus>
                                    <option disabled selected value></option>
                                    <option value="Yes">
                                        Yes
                                    </option>
                                    <option value="No">
                                        NO
                                    </option>
                                    <option value="No original">
                                        No original
                                    </option>

                                </select>

                              </div>
                        </div> 
                        <div class="row">
                              <div class="form-group  col-md-4">

                              <label>Outros documentos:</label>
                                  <select  class="form-control"  id="outros"  name="outros" required autofocus>
                                      <option disabled selected value></option>
                                      <option value="Yes">
                                          Yes
                                      </option>
                                      <option value="N0">
                                          No
                                      </option>
                                      <option value="quitacao">
                                          Quitação
                                      </option>



                                  </select>
                              
                              </div>

                              <div class="form-group  col-md-4">
                                <label>Número de Paginas:</label>
                                  <input class="form-control"  type="number" tyle="width: 100%"  id="npaginas"  name="npaginas" required autofocus>
                                
                              </div>

                              <div class="form-group  col-md-4">
                              <label>Localização do Processo:</label>
                                  <select  class="form-control"  id="lficheiro"  name="lficheiro" required autofocus>
                                      <option disabled selected value></option>
                                      <option value="Archive">
                                          Archive
                                      </option>
                                      <option value="Arrears">
                                          Arrears
                                      </option>
                                      <option value="Credito">
                                          Credito
                                      </option>
                                      <option value="Balcao">
                                          Balcão
                                      </option>
                                      <option value="Linha.de.Cliente">
                                          linha de Cliente
                                      </option>
                                      <option value="Auditor.Externo">
                                          Auditor Externo
                                      </option>
                                      <option value="Auditor.Interno">
                                          Auditor Interno
                                      </option>
                                      <option value="Finance">
                                          Finance
                                      </option>
                                      <option value="Risco">
                                          Risco
                                      </option>
                                      <option value="Advogados">
                                          Advogados
                                      </option>



                                  </select>

                              </div>
                          </div>

                              <div class="row">
                                  <div class="form-group  col-md-4">
                                <label>Arquivado em:</label>
                                    <select  class="form-control"  id="arquivo"  name="arquivo" required autofocus>
                                        <option disabled selected value></option>
                                        <option value="Arq. Definitivo">
                                            Arquivo definitivo
                                        </option>
                                        <option value="Metrofile">
                                            Metrofile
                                        </option>
                                        <option value="Bayport">
                                            Bayport
                                        </option>



                                    </select>

                                  </div>

                              <div class="form-group  col-md-4">
                                <label>Status:</label>
                                    <select  class="form-control"  id="status"  name="status" required autofocus>
                                        <option disabled selected value></option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                        <option value="No">
                                            NO
                                        </option>
                                        <option value="Original">
                                            Original
                                        </option>
                                        <option value="No deal copy">
                                            No deal copy
                                        </option>
                                        <option value="Copy">
                                            Copy
                                        </option>
                                        <option value="deleted">
                                            Deleted
                                        </option>
                                    </select>
                              </div>

                            <div class="form-group col-md-4">
                                <label for="description">Observação</label>
                                    <textarea class="form-control"  type="text"  id="observacao" name="observacao" >{{{ isset($product->description) or '' }}} </textarea>
                            </div>


                            </div>
                            <div class="">
                             <strong>
                                <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar</button>
                              </strong>

                            </div>
                             

            </form>
          </div>
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
                                                $('#usuario').val('');
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
                                              $('#usuario').val(value.name+'; Criado em: '+value.created_at);

                                                if (value.status=="deleted") {
                                                      $(".print-error-msg").find("ul").html('');
                                                      $(".print-error-msg").css('display','block');

                                                      $(".print-error-msg").html("Alerta: Esta Arquivo Foi Apagado").fadeTo(10000, 500).slideUp(500, function(){
                                                          $(".print-error-msg").html("Alerta: Esta Arquivo Foi Apagado").slideUp(10000);
                                                      });

                                                }

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
                                                        $('#usuario').val('');
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
                                                      $('#usuario').val(value.name);

                                                      if (value.status=="deleted") {
                                                           
                                                            $(".print-error-msg").find("ul").html('');
                                                            $(".print-error-msg").css('display','block');

                                                            $(".print-error-msg").html("Alerta: Esta Arquivo Foi Apagado").fadeTo(10000, 500).slideUp(500, function(){
                                                                $(".print-error-msg").html("Alerta: Esta Arquivo Foi Apagado").slideUp(10000);
                                                            });

                                                      }
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
                    var apoliceseguro = $("select[name='apoliceseguro']").val();
                    var nuit = $("select[name='nuit']").val();
                    var bi = $("select[name='bi']").val();
                    var lficheiro = $("select[name='lficheiro']").val();
                    var fsalario = $("select[name='fsalario']").val();
                    var arquivo = $("select[name='arquivo']").val();
                    var tprovimento = $("select[name='tprovimento']").val();
                    var status = $("select[name='status']").val();
                    var observacao = $("textarea[name='observacao']").val();
                    var npaginas = $("input[name='npaginas']").val();
                    var idusuario = $("input[name='idusuario']").val();
                    var extrato = $("select[name='extrato']").val();
                    var nib = $("select[name='nib']").val();
                    var dsalario = $("select[name='dsalario']").val();
                    var outros = $("select[name='outros']").val();

            $.ajax({
              url: "{{URL('arquivogravar')}}",
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
                  $('#usuario').val('');

                  $(".print-success-msg").html(data.success).fadeTo(10000, 500).slideUp(500, function(){
                      $(".print-success-msg").html(data.success).slideUp(10000);
                  });

                }else{
                  errorMsg(data.error);
                }

              },
              error: function(data){

          //pesquisando dados do formulario
          $.ajax({

                type : 'get',

                url : '{{URL::to('arquivosearchnfom')}}',

                data:{'arquivosearchnfom':nform},

                success:function(data){
                  var errors = data.responseJSON;
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
                }})},});
                    }

             });


     


                    // Function to show error messages
              function errorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

                $(".print-error-msg").fadeTo(10000, 500).slideUp(500, function(){
                    $(".print-error-msg").slideUp(10000);
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



        #observacao {
            width: 100%;
            max-width: 100%;
            line-height: 12px;

        }

        input:hover, textarea:hover,
        input:focus, textarea:focus {
            border-color: 1px solid #C9C9C9;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 8px;
        }

 


        .bord0 {
        border-radius: 0;
        }

    </style>


@stop


@stop


