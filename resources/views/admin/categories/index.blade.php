@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
                    </h1>
                    @include('admin.layout.notice')
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent_ID</th>
                        <th>Level</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $cat)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->slug }}</td>
                            <td><?php echo ($cat->parent_id == 0) ? "không có" : $cat->parent_id; ?></td>
                            <td>{{ $cat->level }}</td>
                            <td class="center">
                                {!! Form::open(['method' => 'delete', 'route' => ['category.destroy', $cat->id]]) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="{{ route('category.edit', ['id' => $cat->id]) }}">
                                    Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
