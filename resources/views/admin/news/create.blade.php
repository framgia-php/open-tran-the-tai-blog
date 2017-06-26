@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">News
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('admin.layout.notice')
                    {!! Form::open(['method' => 'POST', 'route' => 'news.store', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group">
                        {!! Form::label('category', trans('messages.category')) !!}
                        {!! Form::select('category_id', $parents, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title', trans('messages.title')) !!}
                        {!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Please Enter Title ...')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('summary', trans('messages.summary')) !!}
                        {!! Form::textarea('summary', null, array('class' => 'form-control ckeditor', 'id' => 'demo')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', trans('messages.content')) !!}
                        {!! Form::textarea('content', null, array('class' => 'form-control ckeditor', 'id' => 'demo')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', trans('messages.image')) !!}
                        {!! Form::file('fileImage', array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('hot', trans('messages.hot')) !!}
                        {!! Form::label('no', trans('messages.no'), array('class' => 'radio-inline')) !!}
                        {!! Form::radio('hot', '0', true, array('class' => 'radio-inline')) !!}
                        {!! Form::label('yes', trans('messages.yes'), array('class' => 'radio-inline')) !!}
                        {!! Form::radio('hot', '1', false, array('class' => 'radio-inline')) !!}
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
