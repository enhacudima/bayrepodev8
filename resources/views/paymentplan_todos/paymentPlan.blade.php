@extends('adminlte::page')

@section('title', 'Bayport | Plano de Pagamento')

@section('content_header')
    <h1>Plano de Pagamento</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>





   <div class="">

        <div style="margin-left: 9.3%">
            <div class="col-md-4"><input type="text" class="form-control" id="inputs" name="inputs" style="width: 100%; " placeholder="Pesquisar pelo LoanID.."></div>
            <div class="col-md-2"><input type="button" onclick="printDiv('printableArea')" value="Imprimir" class="btn btn btn-success"></div>
        </div>

    </div>

    <hr>

<page size="A4" id="printableArea" name="printableArea">
    
   <div class="">

        <div class="col"  ">
            <strong style="font-size: 30px">Plano de Pagamento</strong>                    
                         
        <div class="pull-right" style="margin-right: 20px" ><img src="{{URL::asset('/img/Bayport-Financial-Services-SA-PTY-LTD-1200px-logo.png')}}"  alt="logo" width="200" height="75" ></div>
        </div>  
    </div>
    <br>
    <br>
    <hr>
    <div class="box-body  no-padding">   
        <table class="table table-bordered table-hover table-striped table-sm" id="details" name="details" border="0" >

            <tbody>

            <tr>

                <td>Nome do Cliente:</td>

                <td>---------------</td>

            </tr>

            <tr>

                <td>Periodo:</td>

                <td>---------------</td>

            </tr>

            <tr>

                <td>Montante Desembolsado:</td>

                <td>---------------</td>

            </tr>

            </tbody>

        </table>





                                
        <table class="table-bordered table-hover table-striped table-sm" id="example" name="example" style="width:100%">



            <thead class="thead-light">



            <tr>



                <th>Periodo</th>
                <th>Data de Pagamento</th>
                <th>Juro</th>
                <th>Capital</th>
                <th>Prestação</th>
                <th>Seguro</th>
                <th>Prestação + Seguro</th>
                <th>Saldo de Capital</th>





            </tr>



            </thead>



            <tbody>



            </tbody>



        </table>


             <div class="col-md-12" align="center" style="margin-top: 70px">


                        <!--2-->
                        <div class="form-group col-md-6">
                            

                            <div class="6">
                                <label >{{ __('Gerente do Balcão:') }}<a>    ___________________________________________________</a> </label>
                            </div>
                        </div>
                       <!--2-->
                        <div class="form-group col-md-6">
                            <div class="">
                                <label >{{ __('Departamento de Serviço ao Cliente:') }}<a>   ___________________________________</a></label>
                           </div>
                        </div>

            </div>


  </div>      





</page>


@section('js')



        <script>

            function printDiv(divName) {

                var printContents = document.getElementById(divName).innerHTML;

                var originalContents = document.body.innerHTML;



                document.body.innerHTML = printContents;



                window.print();



                document.body.innerHTML = originalContents;

            }

        </script>





        <script>

            var jqxhr = {abort: function () {}};

            $(document).ready(function(){

                $('#inputs').keyup(function(){

                    $value=$(this).val();

                    $max=$value.length

                    if(7>$max){

                        //alert($max);

                        $('#inputs').css("background-color", "pink");

                    }else{

                        $('#inputs').css("background-color", "#FAFFBD");

                        jqxhr.abort();

                        jqxhr =$.ajax({

                            type : 'get',

                            url : '{{URL::to('searchinformation')}}',

                            data:{'searchinformation':$value},

                            success:function(data){
                                if (!data) {
                                $('#details > tbody') .html("<tr><td><strong>LoanID incorrecto</strong></td></tr>").css("color", "red");
                                }
                                $('#example > tbody') .html(data);

                                //alert(data);

                            }

                        });

                        jqxhr =$.ajax({

                            type : 'get',

                            url : '{{URL::to('searchdetails')}}',

                            data:{'searchdetails':$value},

                            success:function(data){

                                $('#details > tbody') .html(data).css("color", "#333333");

                                //alert(data);

                            }
                        });

                    };
                });
            });



            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });



        </script>

@stop

@section('css')

<style type="text/css">
    body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 35cm;
   
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
</style>


    <style>



        td {

            border-right: 1px solid black;

            border-left: 1px solid black;

            border-top: 1px solid black;

            border-bottom: 1px solid black;

            text-align: center;

            padding: 5px;

        }



        tr{

            height: 0px;

        }

    </style>
@stop


@stop


