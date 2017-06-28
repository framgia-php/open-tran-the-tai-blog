@extends('layouts.index')

@section('content')
    <div class="container">

        <!-- slider -->
    @include('layouts.slide')
    <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layouts.menu')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h2 style="margin-top:0px; margin-bottom:0px;">Laravel News</h2>
                    </div>

                    <div class="panel-body">

                        @foreach($cats as $cat)
                            @if($cat->parent_id == 0 && count($cat->children) > 0)
                                <div class="row-item row">
                                    <h3>
                                        <a href="/">{{$cat->name}}</a> |
                                        @foreach($cat->children as $children)
                                            <small>
                                                <a href="{{ route('news.type', ['id' => $children->id, 'slug'=> $children->slug]) }}">
                                                    <i>{{$children->name}}</i>
                                                </a>/
                                            </small>
                                        @endforeach
                                    </h3>
                                    <?php
                                    foreach ($cat->children as $children) {
                                        $arr[] = $children->id;
                                    }
                                    $data = $news->whereIn('category_id', $arr)->where('hot', 1)->sortByDesc('created_at')->take(5);
                                    $firstNews = $data->shift(); //dạng mảng
                                    ?>
                                    <div class="col-md-8 border-right">
                                        <div class="col-md-5">
                                            <a href="{{ route('news', ['id' => $firstNews['id'], 'slug'=> $firstNews['slug']]) }}">
                                                <img class="img-responsive" src="upload/news/{{$firstNews['image']}}"
                                                     alt="{{$firstNews['slug']}}">
                                            </a>
                                        </div>

                                        <div class="col-md-7">
                                            <a href="{{ route('news', ['id' => $firstNews['id'], 'slug'=> $firstNews['slug']]) }}">
                                                <h3>{{$firstNews['title']}}</h3>
                                            </a>
                                            <p>{!! $firstNews['summary'] !!}</p>
                                            <a class="btn btn-primary"
                                               href="{{ route('news', ['id' => $firstNews['id'], 'slug'=> $firstNews['slug']]) }}">Xem
                                                thêm...
                                                <span
                                                        class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        @foreach($data->all() as $n)
                                            <a href="{{ route('news', ['id' => $n->id, 'slug'=> $n->slug]) }}">
                                                <h4>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                    {{$n->title}}
                                                </h4>
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="break"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
