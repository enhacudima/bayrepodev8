@extends('adminlte::page')

@section('title', 'Bayport | Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>

    <div class="">
      <div class="col-md-4">

        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-exclamation-triangle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Por Processar</span>
            <span class="info-box-number">{{$porarquivar}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($arquivo/$porarquivar)*100}}%"></div>
            </div>
            <span class="progress-description">
              Por processar nos proximos dias 
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>

      </div>

      <div class="col-md-4">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-archive"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Arquivado</span>
            <span class="info-box-number">{{$arquivo}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($arquivo/$porarquivar)*100}}%"></div>
            </div>
            <span class="progress-description">
              Total 
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>


      <div class="col-md-4">
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-snowflake-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Referencias</span>
            <span class="info-box-number">{{$referencias}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              <div class="progress-bar" style="width: {{($arquivo/$porarquivar)*100}}%"></div>
            </div>
            <span class="progress-description">
              Total 
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
    </div>
    <hr>
    <div class="row" id="app">
        <div class="col-md-4">
            <div class="card">

                <div class="panel-body">
                  <div>
                    {!! $chart->container() !!}
                  </div>  
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="panel-body">

                <div >
                    {!! $chart1->container() !!}
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">


                <div class="panel-body">
                <div >
                    {!! $chart2->container() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
<div class="row" id="app">
   <div class="col-md-4">
        <div class="card">
          <div class="panel-body">
                <div >
                    {!! $chart3->container() !!}
                </div>
   
        </div>
   </div> 
</div>
</div>




@section('js')

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
 

{!! $chart->script() !!}
{!! $chart1->script() !!}
{!! $chart2->script() !!}
{!! $chart3->script() !!}

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


