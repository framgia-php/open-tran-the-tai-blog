<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $i = 0; ?>
                @foreach($slides as $sl)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="<?php if ($i == 0) {
                        echo 'active';
                    } ?>"></li>
                    <?php $i++;?>
                @endforeach
            </ol>
            <div class="carousel-inner">
                <?php $j = 0; ?>
                @foreach($slides as $sl)
                    <div class="item <?php if ($j == 0) echo 'active';?>">
                        <img class="slide-image" src="upload/slide/{{$sl->image}}" alt="{{$sl->content}}">
                    </div>
                    <?php $j++;?>
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>
