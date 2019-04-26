@extends('adminlte::page')

@section('title', 'Bayport | Dashboard')

@section('content_header')
    <h1>Ticket Dashboard</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>

    <div class="">
      <div class="col-md-4">

        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-exclamation-triangle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tickets Ativos</span>
            <span class="info-box-number">{{$acteticket}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($acteticket/($acteticket+$completticket+$committicket))*100}}%"></div>
            </div>
            <span class="progress-description">
              Por processar nos proximos dias {{ number_format(($acteticket/($acteticket+$completticket+$committicket))*100, 2) }}% 
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>

      </div>

      <div class="col-md-4">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-archive"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tickets Fechados</span>
            <span class="info-box-number">{{$completticket}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($completticket/($acteticket+$completticket+$committicket))*100}}%"></div>
            </div>
            <span class="progress-description">
              Total {{ number_format(($completticket/($acteticket+$completticket+$committicket))*100, 2) }}%
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>


      <div class="col-md-4">
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-snowflake-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Tickets Comentados</span>
            <span class="info-box-number">{{$committicket}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($committicket/($acteticket+$completticket+$committicket))*100}}%"></div>
            </div>
            <span class="progress-description">
              Total {{ number_format(($committicket/($acteticket+$completticket+$committicket))*100, 2) }}%
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
    </div>
<div class="col-md-12">
<div id="perf_div" style="width:100%;border:1px solid black;position: relative;"></div>
</div>
    <div class="row" id="app">
        <div class="col-md-4">
            <div class="card">

                <div class="panel-body">

                <div >
                    {!! $category->container() !!}
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">

                <div class="panel-body">
                  <div>
                    {!! $subcategory->container() !!}
                 
                  </div>  
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="card">

                <div class="panel-body">
                  <div>
                    {!! $subcategoryday->container()!!}
                 
                  </div>  
                </div>
            </div>
        </div>  

        <div class="col-md-12">
            <div class="card">

                <div class="panel-body">
                  <div>
                    {!! $subcategorybybranch->container()!!}
                 
                  </div>  
                </div>
            </div>
        </div>

        

    </div>


@section('js')

<?= $lava->render('ColumnChart', 'Finances', 'perf_div') ?>


<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
        <!--Graficos-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.7/c3.min.js"></script>



<script src="https://unpkg.com/vue"></script>
<script>
    var app = new Vue({
        el: '#app',

    });


</script>
 

{!! $category->script() !!}
{!! $subcategory->script() !!}
{!! $subcategoryday->script()!!}
{!! $subcategorybybranch->script()!!}
@stop

@section('css')

  <style>
.card-text{
      color: #DDC728;
      font-size: 3rem;
      font-family: "bitter",Georgia,serif;
}


</style>
@stop


@stop
