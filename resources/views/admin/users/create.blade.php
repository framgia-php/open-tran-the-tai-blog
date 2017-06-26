@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('admin.layout.notice')
                    {!! Form::open(['method' => 'POST', 'route' => 'users.store']) !!}

                    <div class="form-group">
                        {!! Form::label('name', trans('messages.name')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Name ...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', trans('messages.email')) !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@example.com']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', trans('messages.password')) !!}
                        {!! Form::password('_password', ['class' => 'form-control', 'placeholder' => 'Please Enter Password ...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password-confirm', trans('messages.confirm')) !!}
                        {!! Form::password('_password_confirmation', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Confirm Password ...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('role', trans('messages.role')) !!}
                        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Add', array('class' => 'btn btn-default')) !!}
                    {!! Form::reset('Reset', array('class' => 'btn btn-default')) !!}
                    {!! Form::close() !!}


                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
