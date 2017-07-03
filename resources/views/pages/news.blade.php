@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$news->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <!-- Preview Image -->
                <img width="25%" class="img-responsive" src="upload/news/{{$news->image}}" alt="{{$news->slug}}">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on: {{$news->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $news->content !!}</p>

                <hr>

                <!-- Blog Comments -->
                <div class="well">
                    @if (Auth::guest())
                        <h4>Bạn phải <a href="{{ route('login') }}">Đăng nhập</a> để viết bình luận.</h4>
                    @else
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        {!!Form::open(['method' => 'POST', 'route' => ['post.comment', $news->id]])!!}
                        <div class="form-group">
                            {!! Form::textarea('content', null, ['class' => 'form-control','size' => '30x5']) !!}
                        </div>
                        {!! Form::submit('Gửi', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}

                    @endif
                </div>

                <hr>

                <!-- Posted Comments -->
                @foreach($news->comments as $cm)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cm->user->name}}
                                <small>{{$cm->created_at}}</small>
                            </h4>
                            {{$cm->content}}
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($relatedNews as $rl)
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="{{ route('news', ['id' => $rl->id, 'slug'=> $rl->slug]) }}">
                                        <img class="img-responsive" src="upload/news/{{$rl->image}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{ route('news', ['id' => $rl->id, 'slug'=> $rl->slug]) }}"><b>{{$rl->title}}</b></a>
                                </div>
                                <div class="break"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach($hotNews as $h)
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="{{ route('news', ['id' => $h->id, 'slug'=> $h->slug]) }}">
                                        <img class="img-responsive" src="upload/news/{{$h->image}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{ route('news', ['id' => $h->id, 'slug'=> $h->slug]) }}"><b>{{$h->title}}</b></a>
                                </div>
                                <div class="break"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
@endsection
