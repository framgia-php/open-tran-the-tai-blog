@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('admin.layout.notice')
                    {!! Form::open(['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('name', trans('messages.name')) !!}
                        {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Please Enter Name ...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', trans('messages.email')) !!}
                        {!! Form::email('email', $user->email, ['class' => 'form-control', 'readonly' => true, 'placeholder' => 'example@example.com']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::checkbox('changePassword', 'on', false, ['class' => 'name', 'id' => 'changePassword']) !!}
                        {!! Form::label('password', trans('messages.change_password')) !!}
                        {!! Form::password('_password', ['class' => 'form-control password', 'disabled' => true, 'placeholder' => 'Please Enter Password ...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password-confirm', trans('messages.confirm')) !!}
                        {!! Form::password('_password_confirmation', ['class' => 'form-control password', 'disabled' => true, 'required' => 'required', 'placeholder' => 'Confirm Password ...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('role', trans('messages.role')) !!}
                        {!! Form::select('role_id', $roles, $user->role_id, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Edit', array('class' => 'btn btn-default')) !!}
                    {!! Form::close() !!}


                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#changePassword").change(function () {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                }
                else {
                    $(".password").prop('disabled', true);
                }
            });
        });
    </script>
@endsection
