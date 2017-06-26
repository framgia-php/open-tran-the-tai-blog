@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('admin.layout.notice')
                    {!!Form::open(['method' => 'POST', 'route' => 'category.store'])!!}
                    <div class="form-group">
                        {!! Form::label('parent_id','Parent Category') !!}
                        <select class="form-control" name="parent_id" id="parent_id">
                            <option value="0">--- Please Select Category---</option>
                            <?php showCategories($categories, $parentMin, $char); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cat_id','Category') !!}
                        {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Please Enter Category Name')) !!}
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

@section('script')
    <script>
        $(document).ready(function () {
            $("#parent_id").change(function () {
                var name = $(this).find('option:selected').attr("name");
                $("#parent_id option:selected").text(name);
            });
        });
    </script>
@endsection
