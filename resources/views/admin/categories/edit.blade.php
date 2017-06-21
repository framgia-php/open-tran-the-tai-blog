@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit
                        <small>{{$category->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('admin.layout.notice')
                    {!! Form::open(['method' => 'PUT', 'route' => ['category.update', $category->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('parent_id','Parent Category') !!}
                        {!! Form::select('parent_id', [ null => '--- Please Select Category---' ] + $parents, $category->parent_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('cat_id','Category') !!}
                        {!! Form::text('name', $category->name, array('class' => 'form-control')) !!}
                    </div>
                    {!! Form::submit('Edit', array('class' => 'btn btn-default')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
