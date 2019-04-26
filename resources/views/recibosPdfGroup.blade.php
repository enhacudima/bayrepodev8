


@foreach ($recibo as $recibo)
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>Commission Payslip</title>

</head>

<body>



  <h1></h1>

  <div >
    <img src="{{URL::asset('/img/Bayport-Financial-Services-SA-PTY-LTD-1200px-logo.png')}}" width="130" height="35" hspace="100"><a style="font-size: 18px;font-weight: 500; font-weight: bold;">Bayport Financial Services Mozambique (MCB)</a>
    <hr>

  
    <div class="title">DATA DE PROCESSAMENTO: {{$today}} #{{$recibo->id}}</div>
       <p id="date"></p>

    
    <div class="scope-entry">
  
      <p id="date"></p>
    </div>
    <hr>
      
    <div>
    <b>Nome do Agente: </b>{{$recibo->agentName}}
      <br>
    <b>Codigo do Agemte: </b>{{$recibo->consultantId}}
      <br>
    <b>NIB do Agente: </b>{{$recibo->nibAgentWithout}}
      <br>
    <b>Agência do Agente: </b>{{$recibo->branch}}
        <br>
    <b>Periodo: </b>{{$recibo->period}}
    </div>
    <br>
    <hr>
    <br>
    <div class="title">Rendimentos Brutos</div>
    <hr>
    <b >Desiguinação</b> <b style="margin-left: 198px; display:inline-block; " >Valor-Bruto (MT)</b> 
    <br><br>
    <a >Comissão</a> <a style="margin-left: 230px; display:inline-block; " >{{$recibo->totalComission}}</a><br>
    <a >Awards</a> <a style="margin-left: 243px; display:inline-block; " >{{$recibo->awards}}</a><br>
    <a >AccomAllowance Mobilizat</a> <a style="margin-left: 111px; display:inline-block; " >{{$recibo->accomAllowanceMobilizat}}</a><br>
    <a >Data Correction</a> <a style="margin-left: 193px; display:inline-block; " >{{$recibo->dataCorrection}}</a><br>
    <hr>
    <b >Total</b> <a style="margin-left: 255px; display:inline-block; " >{{$recibo->totaRendimento}} (MT)</a><br>
    <br>
    
    <br>
    <div class="title">Discontos</div>
    <hr>
    <b >Desiguinação</b> <b style="margin-left: 198px; display:inline-block; " >Valor-Disconto (MT)</b> 
    <br><br>
    <a >IRPS</a> <a style="margin-left: 255px; display:inline-block; " >{{$recibo->irps}}</a><br>
    <a >Outras deduções</a> <a style="margin-left: 183px; display:inline-block; " >{{$recibo->Outrasdeducoes}}</a><br>
    <hr>
    <b >Total</b> <a style="margin-left: 255px; display:inline-block; " >{{$recibo->totalDasDeducoes}}</a><br>
    <br>

    <div class="title">Rendimentos Liquidos</div>
    <hr>
    <b >Desiguinação</b> <b style="margin-left: 198px; display:inline-block; " >Valor-Liquido (MT)</b> 
    <br><br>
    <a >Comissão</a> <a style="margin-left: 230px; display:inline-block; " >{{$recibo->liquidoTotalComission}}</a><br>
    <a >Awards</a> <a style="margin-left: 243px; display:inline-block; " >{{$recibo->liquidoAwords}}</a><br>
    <a >AccomAllowance Mobilizat</a> <a style="margin-left: 111px; display:inline-block; " >{{$recibo->liquidoMobilizacao}}</a><br>
    <a >Data Correction</a> <a style="margin-left: 193px; display:inline-block; " >{{$recibo->dataCorrection}}</a><br>
    <hr>
    <b >Total</b> <a style="margin-left: 255px; display:inline-block; " >{{$recibo->totalliquido}} (MT)</a><br>
    <br>


    <a>Assinatura: ______________________________________</a>
    <br>
    <br>
    </div>

    





      <p>
      <script>
      n =  new Date();
      y = n.getFullYear();
      m = n.getMonth() + 1;
      d = n.getDate();
      document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
      document.getElementById("date2").innerHTML = m + "/" + d + "/" + y;

      </script>
      </p>

@endforeach
</body>

</html>