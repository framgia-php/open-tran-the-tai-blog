@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>List</small>
                    </h1>
                    @include('admin.layout.notice')
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="odd gradeX" align="center">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_id}}</td>

                            <td class="center">
                                {!! Form::open(['method' => 'delete', 'route' => ['users.destroy', $user->id]]) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="{{ route('users.edit', ['id' => $user->id]) }}">
                                    Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="text-align: center;">
                    {{ $users->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
