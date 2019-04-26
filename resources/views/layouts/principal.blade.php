<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" src="https://drive.google.com/open?id=1dVW4q9Rf6qSsYZwpqwpMptafrMNi9twu">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>{{ config('Bayport |MIS', 'Bayport | MIS') }}</title>




        <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->


    <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link href="http://fonts.googleapis.com/css?family=Arimo:400" rel="stylesheet">

        <!--Graficos-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.7/c3.min.js"></script>
        <!--Icons-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>




    <style>


        footer {

            padding: 5px;

            color: #fff;

            text-align: center;

            background-color: rgba(58, 96, 121, 0.8);

            position:fixed;

            bottom: 0px;

            left: 0;

            right: 0;

            z-index: 10;

        }

        .footer a

        {

            color: #ccc;

        }



        #isOnline{

            background: rgba(217, 155, 9, 0.43);

            width: 150px;

            border-radius: 20px 0 0 20px;

            position: fixed;

            right: 0;

            top: 50px;

            z-index: 20;

        }



        #isOnline>h4{

            font-size: 15px;

            text-align: center;

            color: #fff;

        }



        #alert{

            position: fixed;

            top: 50px;

            z-index: 10;

            left: 0;

            right: 0;

        }

    </style>

<!--menu -->
    <style type="text/css">

        body{background:#f9f9f9;}
        #wrapper{padding:90px 15px;}
        .navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;top: 61px;}
        .card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
        .header-top{box-shadow: 0 3px 5px rgba(0,0,0,.1)}
        .leftmenutrigger{display: none}
        @media(min-width:992px) {
        .leftmenutrigger{display: block;display: block;margin: 7px 20px 4px 0;cursor: pointer;}
        #wrapper{padding: 90px 15px 15px 15px; }
        .navbar-nav.side-nav.open {left:0;}
        .navbar-nav.side-nav{background-color: #343A40;box-shadow: 2px 1px 2px rgba(0,0,0,.1);position:fixed;top:56px;flex-direction: column!important;left:-220px;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
        }
        .animate{-webkit-transition:all .3s ease-in-out;-moz-transition:all .3s ease-in-out;-o-transition:all .3s ease-in-out;-ms-transition:all .3s ease-in-out;transition:all .3s ease-in-out}

        .navbar-nav.side-nav {

            width: 220px;
        }


    </style>


    <!--novo css cunstumizando toda APP-->
        <style>
        body {
            padding: 50px 100px;
            font-size: 13px;
            font-style: Verdana, Tahoma, sans-serif;
        }

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



        textarea {
            width: 400px;
            height: 400px;
            max-width: 400px;
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
            color: #999999;
        }

        /* ===========================
           ====== Submit Button ======
           =========================== */

        .submit input {
            width: 100px;
            height: 40px;
            background-color: #474E69;
            color: #FFF;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        select{
            font-family:'Nunito', sans-serif;
            font-size: 16px;
            box-shadow:rgba(0, 0, 0, 0.1) 0px 0px 8px ;
            color: #999999;
            border: 1px solid #E5E5E5;
            width: 200px;
            height: 41px;
        }

        #textarea{
            resize: horizontal;
            width: 1200px;
            height: 90px;

        }

    </style>
    <!--Out radius bottons-->
    <style type="text/css">
     /*Specific Cases*/

        .btn.btn-custom-lg,
        .btn.btn-custom-sm,
        .btn.btn-custom-xs {
         border-radius: 0;
        }
    /*Global*/

        .btn.btn-square {
        border-radius: 0;
        }

        .largura{width: 165px;}
    </style>

    <style>
    /*menu dropdown*/
        button[name="drop"]{
        border: none;
        cursor: pointer;
        background-color: #343A40;
        padding: 5px;
        font-size: 12px;
        color: #FFFFFF;
      }

        .drop-content{
        display: none;
        background-color: #009FE3;
        }

        .drop-content a{
        color: white;
        padding: 8px 10px;
        text-decoration: none;
        display: block;
      }

        .menu-drop:hover .drop-content{
        display: block;
      }

        .menu-drop:hover button[name="drop"]{
        color: #C9936F
      }

        .drop-content a:hover{
        background-color: #C9936F;
      }


        .menu-drop{
        position: relative;
      }

    </style>


    <script>

        window.addEventListener('load', function(e) {

            if (navigator.onLine) {

                $('#isOnline h4').html('We\'re online!');

                $('#isOnline').css('background','rgb(182, 202, 160)');

                console.log('We\'re online!');

            } else {

                $('#isOnline h4').html('We\'re offline...');

                $('#isOnline').css('background','rgba(217, 155, 9, 0.43)');

                console.log('We\'re offline...');

            }

        }, false);



        window.addEventListener('online', function(e) {

            $('#isOnline h4').html('And we\'re back :).');

            $('#isOnline').css('background','rgb(182, 202, 160)');

            console.log('And we\'re back :).');

        }, false);



        window.addEventListener('offline', function(e) {

            $('#isOnline h4').html('Connection is down.');

            $('#isOnline').css('background','rgba(217, 155, 9, 0.43)');

            console.log('Connection is down.');

        }, false);

    </script>

    <script type="text/javascript">
        $( document ).ready(function() {
     $('.leftmenutrigger').on('click', function(e) {
     $('.side-nav').toggleClass("open");
     e.preventDefault();
    });
});
    </script>








</head>
<body  >


<div id="wrapper" class="animate">
    <nav class="navbar  header-top  navbar-fixed-top navbar-expand-lg navbar-dark bg-dark">
      <span class="navbar-toggler-icon leftmenutrigger"></span>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">

                     @guest
                     @else


        <ul class="navbar-nav animate side-nav">
          <li class="nav-item">
            <a class="navbar-brand" href="{{ url(route('home')) }}"><img src="{{URL::asset('/img/Bayport-3.jpg')}}"  alt="logo" width="190" height="120"></a>
          </li>

          <li class="nav-item" style="margin-top: 100px; margin-left: 10px; margin-right: 10px">
            <a class="nav-link" href="{{ url(route('home')) }}"><i class="fa fa-home"></i> Home
            </a>
          </li>
          <br>

        <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
            <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-tachometer" aria-hidden="true"></i>   Dashboard</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                    <a href="#">Daily report</a>
                    <a href="#">Em breve</a>
                    <div class="dropdown-divider"></div>
                    <a href="#">help</a>
                </div>
        </li>

          <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
                <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-line-chart" aria-hidden="true"></i>   Plano de Pagamento</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                     @if(Auth::user()->level=='4'|| Auth::user()->level=='4'|| Auth::user()->level=='7' )
                    <a class="dropdown-item" href="{{ url(route('paymentPlan')) }}">Plano</a>
                     @endif
                     @if(Auth::user()->level=='4'|| Auth::user()->level=='4' )

                    <a class="dropdown-item" href="{{ url(route('importdata')) }}">Caregar Ficheiro+</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><strong>help</strong></a>
                </div>
          </li>

          <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
                <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-quora" aria-hidden="true"></i>    Q.A</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                    @if(Auth::user()->level=='1'|| Auth::user()->level=='4'|| Auth::user()->level=='2' )
                    <a class="dropdown-item" href="{{ url(route('homefuncionario')) }}">NIB</a>
                    @endif
                    @if(Auth::user()->level=='4'|| Auth::user()->level=='2' )
                    <a class="dropdown-item" href="{{ url(route('homesal')) }}">Salario</a>
                    @endif
                    @if(Auth::user()->level=='4'|| Auth::user()->level=='2' )
                    <a class="dropdown-item" href="{{ route('funcionarionovo') }}">Cadastrar Novo+</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><strong>help</strong></a>
                </div>
          </li>

          <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
                <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-paypal" aria-hidden="true"></i>   Agent Payroll</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                    @if(Auth::user()->level=='4'|| Auth::user()->level=='6')
                    <a class="dropdown-item" href="{{ url(route('selection')) }}">Recibos</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><strong>help</strong></a>
                </div>
          </li>

          <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
                <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-ticket" aria-hidden="true"></i></i>  Open new Ticket</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                   
                    <a class="dropdown-item" href="{{ url('myticket') }}">My Ticket</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><strong>help</strong></a>
                    
                </div>
          </li>

          <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
                <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-archive" aria-hidden="true"></i>  Arquivo Master</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                    @if(Auth::user()->level=='4'||Auth::user()->level=='8'||Auth::user()->level=='9')
                    <a class="dropdown-item" href="{{ url('arquipainel') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ url('arquivomaster') }}">Arquivo Master</a>
                    <a class="dropdown-item" href="{{ url('arquivoreferencias') }}">Arquivo Referencia</a>
                    <a class="dropdown-item" href="{{ url('arquivoreportindexreport') }}">Arquivo Reporte</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><strong>help</strong></a>
                    @endif
                </div>
          </li>

          <li class="nav-item" style="margin-top: 2px; margin-left: 10px; margin-right: 10px">
                <div class="menu-drop">
                <!-- Split dropright button -->
                <button type="button" name="drop"><i class="fa fa-cog" aria-hidden="true"></i>  Settings</button>
                <!-- Dropdown menu links -->
                <div class="drop-content">
                    @if(Auth::user()->level=='4')
                    <a class="dropdown-item fa fa-cog" href="{{ url(url('adminarea')) }}">Admin Area</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><strong>help</strong></a>
                </div>
          </li>
        </ul>

        <ul class="navbar-nav ml-md-auto d-md-flex pull-right">
            <li class="nav-item pull-right">

            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i></use></svg> {{ Auth::user()->name }} {{ Auth::user()->lname }}
                        <span class=""></span></a>

                        <ul class="dropdown-menu" role="menu" style="   background-color: #343a40;" >

                            <li id="updateU" ><a href="{{ route('changePassword') }}" style="color: #C8C8C8;"><i class="fa fa-key" aria-hidden="true"></i> Mudar Password</a>

                            </li>                            

                            <li id="updateU"><a href="{{ url('updatep') }}" style="color: #C8C8C8;"><i class="fa fa-phone" aria-hidden="true"></i> Configuar Telefone</a>

                            </li>

                            <li><a href="{{ route('logout') }}" style="color: #C8C8C8;"><i class="fas fa fa-sign-out" aria-hidden="true"></i> Sair</a>

                            </li>

                        </ul>
          </li>

        </ul>
      </div>
    </nav>



    <div class="container-fluid">

            @yield('content')

  </div>

            @endif

</div>






                <footer class="footer" >
                      <div class="copyright" >
                    2018 © Copyright | Bayport. <a href="http://evidevi.com/" target="_blank">Powered by: MIS</a>
                </div>
                </footer>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $('.textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
</body>
</html>
