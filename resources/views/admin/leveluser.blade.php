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
                  <h4 class="card-title ">Level</h4>
                  <p class="card-category"> User Level</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                            <div class="col-lg-3">
        <form method="post" action="{{url('/saveleveluser')}}" autocomplete="Active" accept-charset="UTF-8" >

            {{ csrf_field() }}

            <input   name="fk_user_id" type="hidden" id="fk_user_id" value="{{ Auth::user()->id }}">
            <div class="row">
              <div class="from-group col-lg-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Descrção</label>
                    <input id="discricao" type="text" class="form-control{{ $errors->has('discricao') ? ' is-invalid' : '' }}" name="discricao" value="{{ old('username') }}" required autofocus>
                          @if ($errors->has('discricao'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('discricao') }}</strong>
                              </span>
                          @endif
            </div>
            </div>
            </div>       

            <div class="row">
                    <div class="from-group col-lg-12">
                          <div class="form-group">
                          <label class="bmd-label-floating">Detalhes</label>
                          <input id="discricao" type="text" class="form-control{{ $errors->has('detalhes') ? ' is-invalid' : '' }}" name="detalhes" value="{{ old('detalhes') }}" required autofocus>
                                @if ($errors->has('detalhes'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('detalhes') }}</strong>
                        </span>
                    @endif
            </div>
                    </div>
            </div>       
     

            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>   
                
           
        </form>
        

    </div>
    

    <div class="col-lg-12">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Category List
        </h4>
    </div>

    <div class="panel-body">

        
                      
                    <table class="table table-hover" id="example">
                      <thead class=" text-primary">
                          <tr>
            
                              <th scope="col">#</th>
                              <th scope="col">Discrição</th>
                              <th scope="col">Detalhes</th>
                              <th scope="col">Action</th>
                              <th scope="col">Last update</th>
                          </tr>
                          </thead>
                          <tbody>
                          @if(isset($leveluser))
                          @foreach($leveluser as $cli)
                          <tr>  
                          <td>{{$cli->id}}</td>
                          <td class="text-primary">{{$cli->discricao}}</td>
                          <td class="text-primary">{{$cli->detalhes}}</td>
                           <td>
                           <a class="btn btn btn-success btn-xs" href="">
                              <i class="fa fa-pencil fa-fw"></i> Edit
                           </a>
                           </td>
                           <td>{{$cli->updated_at}}</td>
                          </tr>
                           @endforeach
                          @endif
                          </tbody>
                      </table>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <script type="text/javascript">
        $(document).ready(function() {
          $('#example').DataTable( {
              columnDefs: [
                  {
                      targets: [ 0, 1, 2 ],
                      className: 'mdl-data-table__cell--non-numeric'
                  }
              ]
          } );
      } );
      </script>
  @endsection