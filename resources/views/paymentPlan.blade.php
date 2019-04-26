@extends('layouts.principal')



@section('content')

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


    <div class="container" style="margin-left:220px ">

        <div class="row column-md-12">

            <input type="text" class="form-control" id="inputs" name="inputs" style="width: 180px; margin-left: 15px" placeholder="Type Loan ID"></input>

            <input type="button" onclick="printDiv('printableArea')" value="PRINT" class="btn btn btn-success" style="margin-left: 5px"></input>

            

        </div>

    </div>

    <br>

<page size="A4" id="printableArea" name="printableArea">
    
   <div class="row">

        <div class="col"  ">
            <strong style="font-size: 50px">Plano de Pagamento</strong>                    
        </div>
                       

                        
        <div class="" style="margin-right: 20px" ><img src="{{URL::asset('/img/Bayport-Financial-Services-SA-PTY-LTD-1200px-logo.png')}}"  alt="logo" width="200" height="100" >
        </div>

    </div>
    <hr>
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



                                            <tr>





                                            </tbody>

                                        </table>



                                
                                <table class="table table-bordered table-hover table-striped table-sm" id="example" name="example" style="width:100%">



                                    <thead class="thead-light">



                                    <tr>



                                        <th>Periodo</th>



                                         <th>Capital</th>



                                        <th>Data de Pagamento</th>



                                        <th>Juro</th>



                                        <th>Prestação</th>



                                        <th>Seguro</th>



                                        <th>Prestação + Seguro</th>



                                        <th>Saldo de Capital</th>





                                    </tr>



                                    </thead>



                                    <tbody>



                                    </tbody>



                                </table>

                         <div class="row col-md-12" align="center">

                            <div class="col-md-6">

                                <a>Gerente do Balcão</a>

                            </div>

                            <div class="col-md-6">

                                <a>Departamento de Serviço ao Cliente</a>

                            </div>



                        </div>

                        <div class="row col-md-12" align="center">

                            <div class="col-md-6">

                                <a>___________________________________</a>

                            </div>

                            <div class="col-md-6">

                                <a>___________________________________</a>

                            </div>



                        </div>


</page>












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

                $('#inputs').keydown(function(){

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

                                $('#example > tbody') .html(data);

                                //alert(data);

                            }

                        });

                        jqxhr =$.ajax({

                            type : 'get',

                            url : '{{URL::to('searchdetails')}}',

                            data:{'searchdetails':$value},

                            success:function(data){

                                $('#details > tbody') .html(data);

                                //alert(data);

                            }
                        });

                    };
                });
            });



            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });



        </script>









        <script type="text/javascript">



            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });



        </script>



@endsection
