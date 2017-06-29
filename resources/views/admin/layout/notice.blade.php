@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            {{$err}}<br>
        @endforeach
    </div>
@endif
@if(session('notice'))
    <div class="alert alert-success">
        {{session('notice')}}
    </div>
@endif
@if(session('notice_error'))
    <div class="alert alert-danger">
        {{session('notice_error')}}
    </div>
@endif
@if(session('message'))
    <div class="alert alert-danger">
        {{session('message')}}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
