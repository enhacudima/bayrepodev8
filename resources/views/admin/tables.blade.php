@extends('admin.layouts.admin')

@section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">User List</h4>
                  <p class="card-category"> Active users</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="example">
                      <thead class=" text-primary">
                      <th>ID</th>
                      <th scope="col"><i class="fa fa-fw fa-user"></i> Nome</th>
                      <th scope="col"><i class="fa fa-fw fa-envelope-open"></i> Email</th>
                      <th>PHONE</th>
                      <th scope="col"><i class="fa fa-fw fa-calendar"></i> Data de criação </th>
                      <th scope="col"><i class="fa fa-fw fa-calendar"></i> Data da ultima atualização </th>
                      <th scope="col"><i class="fa fa-fw fa-arrows-v"></i> Nivel de acesso</th>
                      <th scope="col"><i class="fa fa-fw fa-snowflake-o"></i> Estado</th>
                      <th cope="col"><i class="fa fa-fw fa-gears"></i> Acções</th>
                      <th cope="col"><i class="fa fa-fw fa-gears"></i> Acções</th>
                      <th cope="col"><i class="fa fa-fw fa-gears"></i> Acções</th>
                      </thead>
                      <tbody>
                        @if(isset($users))
                        @foreach($users as $cli)
                        <tr>  
                        <td>{{$cli->id}}</td>
                        <td>{{$cli->name}}</td>
                        <td class="text-primary">{{$cli->email}}</td>
                        <td>{{$cli->phone}}</td>
                        <td>{{$cli->created_at}}</td>
                        <td>{{$cli->updated_at}}</td>        
                        <td>{{$cli->discricao}}</td>
                        @if( $cli->status == 1)

                        <td>Ativo</td>
                        @else
                        <td>Desativado</td>
                        @endif
                        <td>
                        <a class="btn btn btn-success btn-xs" href="{{action('ListUserController@edituser', $cli->id)}}">
                            <i class="fa fa-pencil fa-fw"></i> Edit
                        </a>
                        </td>
                        <td>
                        <a class="btn btn btn-success btn-xs" href="{{action('ListUserController@editpassword', $cli->id)}}">
                            <i class="fa fa-pencil fa-fw"></i> Reset Password
                        </a>
                        </td>
                        <td>
                        <a class="btn btn-danger btn-xs" href="{{action('ListUserController@deleteuser', $cli->id)}}">
                            <i class="fa fa-trash-o fa-lg"></i> Delete
                        </a>
                        </td>
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