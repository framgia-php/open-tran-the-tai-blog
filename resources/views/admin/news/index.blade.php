@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">News
                        <small>List</small>
                    </h1>
                    @include('admin.layout.notice')
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Content</th>
                        <th>Hot</th>
                        <th>Views</th>
                        <th>Category</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $n)
                        <tr class="odd gradeX" align="center">
                            <td>{{$n->id}}</td>
                            <td>
                                <p>{{$n->title}}</p>
                                <img width="100px" src="upload/news/{{$n->image}}" alt="{{$n->slug}}">
                            </td>
                            <td>{!! substr($n->summary,0,120) !!}....</td>
                            <td>{!! substr($n->content,0,150) !!}....</td>
                            <td>
                                @if($n->hot == 0)
                                    {{'Không'}}
                                @else
                                    {{'Có'}}
                                @endif
                            </td>
                            <td>{{$n->views}}</td>
                            <td>{{$n->category->name}}</td>
                            <td class="center">
                                {!! Form::open(['method' => 'delete', 'route' => ['news.destroy', $n->id]]) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="{{ route('news.edit', ['id' => $n->id]) }}">
                                    Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="text-align: center;">
                    {{ $news->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
