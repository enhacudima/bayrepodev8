<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style type="text/css">
    .form-gap {
    padding-top: 70px;
}
</style>

</head>
<body>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Mensagens-->
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible textcenter" role="alert" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    @if ( Session::has('error') )
        <div class="alert alert-danger alert-dismissible textcenter" role="alert" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif

    <!-- /Mensagens-->

 <div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Atualização de Segurança</h2>
                  <p>Confirmação do codigo de segurança</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="POST" action="{{ url('/confirmupdatephone') }}" aria-label="{{ __('Atualização de Segurança') }}">
                        {{ csrf_field() }}
                        

    
                      <div class="form-group">                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-phone color-blue"></i></span>
                          <input id="tokens"name="tokens" placeholder="Codigo de Confirmação" class="form-control {{ $errors->has('tokens') ? ' is-invalid' : '' }}"  type="text"  required>
                          <input type="hidden" name="pnumber" value="{{ $pnumber }}">
                          <input type="hidden" name="email" value="{{ $email }}">


                        </div>
                                @if ($errors->has('tokens'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tokens') }}</strong>
                                    </span>
                                @endif
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block " value="Validar" type="submit">
                      </div>
                      
                    </form>                      
    
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</body>
</html>


