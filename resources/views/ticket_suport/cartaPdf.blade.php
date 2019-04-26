


<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>Carta de Solicitacao de Reembolco</title>

  <style type="text/css">
    .mar{
      margin-left: 500px

    }

    .marx{
      margin-left: 380px

    }
    .marbut{
      margin-left: 20px
      margin-right:20px;
    }

    .top{
      margin-top: 30px
    }


    .fotb{
      font-size: 15px;
      font-weight: 500;
      font-weight: bold;
    }

    .fotbbu{
      font-size: 10px;
      font-weight: 500;
      font-weight: bold;
    }

      .fot{
      font-size: 15px;
      font-weight: 500;
    }

    .fotbu{
      font-size: 10px;
      font-weight: 500;
    }

    .posi{
     text-align: center;
    }

    .deco{
      text-decoration: none;
    }
    .footer{
      position: fixed;
      left: 20px;
      right: 20px;
      bottom: 30px;
      width: 100%;
      text-align: left;

    }
    .textjusty{
      text-align: justify;
      text-justify:inter-word;
    }

    .oppa{
      opacity: 0.5;
      filter: alpha(opacity=50);
    }

    .unline{
      text-decoration: underline;
    }

  </style>

</head>

<body>



  <h1></h1>

  <div >
    <div class="mar oppa">
    <img  src="{{URL::asset('/img/Bayport-Financial-Services-SA-PTY-LTD-1200px-logo.png')}}" width="180" height="70" hspace="0" >
    </div>
    <br>
    <div class="top marx ">
    <a class="fotb">Exmo. Sr. (a): </a><a class="fot">{{$data->ClientFirstNames}}</a><br>
    <a class="fotb">CC: Agência da: </a><a class="fot">{{$data->outletSyncNameCorrected}}</a><br>
    <a class="fotb unline">PROVINCIA: </a><a class="fot">{{$data->name}}</a><br>
    </div>


    <div>
    <a class="fotb">Nossa Ref.:</a><a class="fot">_____/DC/GN/BFSM/2018</a><br>
    <a class="fotb">Data      : </a><a class="fot">Maputo, {{$today}}</a><br>
    <a class="fotb">Assunto   : </a><a class="fot">Resposta a reclamação do Sr. {{$data->ClientFirstNames}}</a><br>
    </div>
    <div class="fot top">
      Exmos. Senhores,
    </div>

    <div class="fot textjusty">
      A Bayport Financial Services Moçambique (MCB), S.A., com sede na Avenida 25 de Setembro, Nº 1147, 3º andar, Distrito Urbano Nº 1 – na Cidade de Maputo, uma sociedade anonima de direito Moçambicano, com capital social de 1,905,808,000.00 MT (Um Bilião, Novecentos e Cinco Milhões, Oitocentos e Oito Mil Meticais), matriculada junto a Conservatória do Registo das Entidades Legais sob o número 100312530, titular do NUIT 400376328, vem por este meio acusar a recepção da V. missiva datada de {{$create}}, cujo o teor mereceu a nossa melhor atenção.
    </div><br><br>

    <div class="fot textjusty">
      Relativamente a vossa reclamação, somos de esclarecer que ocorreram problemas técnicos que deram lugar a ({{$data->comentarios}}) de descontos, situação esta já regularizada, pelo que, confirmamos que o crédito está devidamente liquidado e que o valor descontado indevidamente na ordem de xxxxxx meticais (xxxxx por extenso) será reembolsado até o dia XX/XX/XXXX .
    </div><br><br>


    <div class="fot textjusty">
      Aproveitamos para informar que estamos a vossa inteira disposição para prestar esclarecimentos adicionais caso V. Excia requeira.
    </div><br><br>

    <div class="fot">
      De V. Excia,
    </div>
    <div class="fot">
      Atenciosamente
    </div>

    <div class="fot posi" >
      Departamento de Serviço ao Cliente
    </div><br>

    <div class="fot posi" >
      _____________________
    </div><br>
    <div class="fotb posi" >
      Bias Tembe
    </div><br>
    <div class="fotb posi" >
      /Responsável pelo Departamento/
    </div><br>
    <div class="marbut oppa">
    <img src="{{URL::asset('/img/image (6).png')}}"  alt="logo" width="70" height="43"  hspace="0"><br>
    <div class="fotb">
    ______________________________________________________________________________________________
    </div><br>

    <div class="fotbbu">
    Bayport Financial Services Moçambique (MCB), S.A.
    </div>
    <div class="fotbu">
    Avenida 25 de Setembro, N° 1147, 3° Andar, Maputo, Moçambique
    </div>
    <div class="fotbu">
    Caixa Postal 857, Maputo, Moçambique • Telefone: +258 21 420 260/1  - Telefone: +258 21 420 275
    </div><br>

    <div class="fotbu ">
      <a class="deco" href="www.bayportfinance.com">www.bayportfinance.com</a>
    </div>
    </div>



    </div>



</body>

</html>
