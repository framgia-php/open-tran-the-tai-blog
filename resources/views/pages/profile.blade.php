@extends('layouts.index')

@section('content')
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
                        @include('admin.layout.notice')
                        {!! Form::open(['method' => 'PUT', 'route' => 'put.profile']) !!}

                        <div class="form-group">
                            {!! Form::label('name', trans('messages.name')) !!}
                            {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Please Enter Name ...']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', trans('messages.email')) !!}
                            {!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'readonly' => true]) !!}
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

                        {!! Form::submit('Edit', array('class' => 'btn btn-default')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
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
