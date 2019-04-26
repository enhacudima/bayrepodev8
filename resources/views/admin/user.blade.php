@extends('admin.layouts.admin')

@section('content')
      <div class="content">

            <div>
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- /Mensagens-->
            </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Creat Profile</h4>
                  <p class="card-category">Complete user profile</p>
                
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                     @csrf
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Title</label>
                          <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fist Name</label>
                          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" required autofocus>
                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input id="pnumber" type="number" class="form-control{{ $errors->has('pnumber') ? ' is-invalid' : '' }}" name="pnumber" value="{{ old('pnumber') }}" ">
                                @if ($errors->has('pnumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pnumber') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                                <select id="city" type="" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('level') }}" required autofocus>
                                    <option disabled selected value>City..</option>        
                                                    @if(isset($provincia))
                                                        @foreach($provincia as $provincia)
                                                            <option value="{{$provincia->province_id}}" > {{$provincia->name}}</option>
                                                        @endforeach
                                                    @endif  
                                </select> 
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                                <select id="branch" type="" class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}" name="branch" value="{{ old('branch') }}" required autofocus>
                                    <option disabled selected value>Branch..</option>        
                                                     
                                </select> 
                                @if ($errors->has('branch'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('branch') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                                <select id="level" type="" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" value="{{ old('level') }}" required autofocus>
                                    <option disabled selected value>Level..</option>
                                                    @if(isset($nivel))
                                                        @foreach($nivel as $nivel)
                                                            <option value="{{$nivel->id}}">{{$nivel->discricao}}</option>
                                                        @endforeach
                                                    @endif    

                                </select> 
                                @if ($errors->has('level'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>    
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Confirm Password</label>    
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                      </div>
                     </div>     
                    <button type="submit" class="btn btn-primary pull-right">Save User</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#city').change (function(){
      $value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('searchbranch')}}',
        data:{'searchbranch':$value},

        success:function(data){
        $('select[name="branch"]').html(data);
        }
    })
    });
  });
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>    
      
 @endsection