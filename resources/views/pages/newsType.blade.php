@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$category->name}}</b></h4>
                    </div>
                    @foreach($news as $n)
                        <div class="row-item row">
                            <div class="col-md-3">
                                <a href="{{ route('news', ['id' => $n->id, 'slug'=> $n->slug]) }}">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive"
                                         src="upload/news/{{$n->image}}"
                                         alt="">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <a href="{{ route('news', ['id' => $n->id, 'slug'=> $n->slug]) }}"><h3>{{$n->title}}</h3></a>
                                <p>{!! $n->summary !!}</p>
                                <a class="btn btn-primary" href="{{ route('news', ['id' => $n->id, 'slug'=> $n->slug]) }}">Xem thêm <span
                                            class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach
                    <div style="text-align: center">
                        {{$news->links()}}
                    </div>
                </div>
            </div>

        </div>
@endsection
