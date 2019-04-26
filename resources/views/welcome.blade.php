<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bayport</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #f9f9f9;
                color: #000000;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

         <style type="text/css">
        #slideshow {
                      margin: 80px auto;
                      position: relative;
                      width: 1500px;
                      max-width: 90%;
                      height: 600px;
                      padding: 10px;
                      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
                    }

#slideshow > div {
                  position: absolute;
                  top: 10px;
                  left: 10px;
                  right: 10px;
                  bottom: 10px;
                }

    </style>



    <style type="text/css">

            .banner-text {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 50%;
                max-width: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                z-index: 99;
            }

            h1,
            h2 {
                color: #ffffff;
                font-weight: bold;
                text-transform: uppercase;
                margin-bottom: 0;
                margin-top: 0;
                line-height: 0.8;
                text-shadow: 0 0 50px #fff;
                transform: translateZ(130px);
                -webkit-transform: translateZ(130px);
                -moz-transform: translateZ(130px);
                color: hsla(0, 0%, 0%, 0);
                -webkit-transform-style: preserve-3d;
                -moz-transform-style: preserve-3d;
                transform-style: preserve-3d;
                -webkit-transform: translate3d(0, 0, 0);
                -moz-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
                letter-spacing: 100px;
                opacity: 0;
                -webkit-animation: OpeningSequence 3.2s ease forwards;
                -moz-animation: OpeningSequence 3.2s ease forwards;
                animation: OpeningSequence 3.2s ease forwards;
            }

            h1 {
                font-size: 6.9vw;
            }

            h2 {
                font-size: 1.5vw;
            }

            #title-behind,
            #title-the,
            #title-lens,
            #subtitle {
                letter-spacing: 0px;
                opacity: 1;
                transform: translateZ(20px);
                -webkit-transform: translateZ(20px);
                -moz-transform: translateZ(20px);
            }

            #title-behind {
                text-shadow: 0 0 15px #fff;
            }

            #title-the {
                text-shadow: 0 0 5px #fff;
            }

            #title-lens,
            #subtitle {
                text-shadow: 0 0 0px #fff;
            }

            #subtitle {
                margin-top: 30px;
            }


    </style>



    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    @else
                        <a href="{{ route('login') }}"><i class="fa fa-lock" aria-hidden="true"></i> Login</a>
                        
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="{{URL::asset('/img/image (6).png')}}"  alt="logo" width="120" height="80">
                    Bayport
                </div>

                 <div class="box-body table-responsive no-padding">    
                <div id="slideshow">
                   <div style=" background-color: #383838;">
                        <div class="container">
                            <div class="row">
                                <div class="banner-text" >
                                <h1 id="title-behind">Welcome</h1>
                                <h1 id="title-the">To The</h1>
                                <h1 id="title-lens">New</h1>
                                <h2 id="subtitle">Professional Platform</h2>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div style=" background-color: #993EBB;" >
                                <div class="banner-text" >
                                <h1 id="title-behind">Welcome</h1>
                                <h1 id="title-the">To</h1>
                                <h1 id="title-lens">MIS</h1>
                                <h2 id="subtitle">Portal</h2>
                                </div>
                   </div>
                   <div style=" background-color: #D36CA6;">
                                <div class="banner-text" >
                                <h1 id="title-behind"></h1>
                                <h1 id="title-the"></h1>
                                <h1 id="title-lens">let's start! </h1>
                                <h2 id="subtitle"></h2>
                                </div>
                   </div>
                      <div style=" background-color: #383838;">
                        <div class="container">
                            <div class="row">
                                <div class="banner-text" >
                                <h1 id="title-behind">!</h1>
                                <h1 id="title-the">Encotre</h1>
                                <h1 id="title-lens">As aplicações</h1>
                                <h2 id="subtitle">No menu de navegação aplicações</h2>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                </div>

                <div class="links">

                </div>
            </div>
        </div>

        <script type="text/javascript">
        $("#slideshow > div:gt(0)").hide();

        setInterval(function() {
          $('#slideshow > div:first')
            .fadeOut(1000)
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('#slideshow');
        }, 3000);

        </script>
    </body>
</html>
