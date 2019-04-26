@extends('layouts.app')

@section('content')






	
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Usuarios</div>
                
                <table class="table table-hover">

    			<thead>

      			<th>Nome</th>

      			<th>Email</th>

    			</thead>

    			<tbody>
				
				@foreach($users as $user)

        		<tr>

          		<td>{{$user->username}} </td>

          		<td>{{$user->purchases}} </td>

        		</tr>
				@endforeach

    			</tbody>

				</table>

                <div class="card-body">
                   
                </div>
            </div>
        </div>
    </div>




    <script>

        $(document).ready(function() {

            $('#user').DataTable( {

                "scrollY": 200,

                "scrollX": true,

                dom: 'Bfrtip',

                buttons: [

                    'csv', 'excel', 'pdf', 'print','colvis'

                ]

            } );





        } );

    </script>


@endsection
