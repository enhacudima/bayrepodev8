@extends('adminlte::page')

@section('title', 'Bayport | Plano de Pagamento Uploud')

@section('content_header')
    <h1>Plano de Pagamento</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="container">
        <h2 class="text-center">
            Import Client and Loans Details Report
        </h2>



        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif

        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div id="myModal" class="modal fade">
          <div class="modal-dialog ">
            <div class="modal-content alert-danger">
              <!-- dialog body -->
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                Todos dados serão compartilhados com todas aplicações afiliadas!!!
                
              </div>
              <!-- dialog buttons -->
              <!--<div class="modal-footer"><button type="button" class="btn btn-primary">OK</button></div>-->
            </div>
          </div>
        </div>

      <!-- dialog buttons -->

        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            Choose your xls/csv File : <input type="file" name="file" class="form-control">
            <br>
              <div class = "progress" > 
                <div class = "progress-bar progress-bar-striped" > </div> 
              </div>

            <input id="animer" name="animer" type="submit" class="btn btn-primary "  value="Upload" style="margin-top: 3%" >
        </form>
        <br>
        <a class="btn btn-info" href="{{ route('file-download') }}"><i class="fa fa-cloud-download" aria-hidden="true"></i> Ficheiro exemplo</a> 

    </div>




@section('js')



<script>
  function timer(n) {
    $(".progress-bar").css("width", n + "%")
    if(n < 3000) {
      setTimeout(function() {
        timer(n + 1)
      }, 20)
    }
  }
  $(function (){
    $("#animer").click(function() {
      timer(0)
    })
  })
</script>

<script>
    $("#myModal").on("show", function() {    // wire up the OK button to dismiss the modal when shown
        $("#myModal a.btn").on("click", function(e) {
            console.log("button pressed");   // just as an example...
            $("#myModal").modal('hide');     // dismiss the dialog
        });
    });
    $("#myModal").on("hide", function() {    // remove the event listeners when the dialog is dismissed
        $("#myModal a.btn").off("click");
    });
    
    $("#myModal").on("hidden", function() {  // remove the actual elements from the DOM when fully hidden
        $("#myModal").remove();
    });
    
    $("#myModal").modal({                    // wire up the actual modal functionality and show the dialog
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     // ensure the modal is shown immediately
    });
</script>

@stop

@section('css')

@stop


@stop


