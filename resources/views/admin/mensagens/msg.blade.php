@if(Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif