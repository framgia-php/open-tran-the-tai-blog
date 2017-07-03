<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel News</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/">Introduce</a>
                </li>
                <li>
                    <a href="/">Contact</a>
                </li>
            </ul>

            {!!Form::open(['method' => 'GET', 'route' => 'get.search', 'class' => 'navbar-form navbar-left'])!!}
            <div class="form-group">
                {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
            </div>
            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
            {!! Form::close() !!}

            <ul class="nav navbar-nav pull-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                {!! Form::open(['id' => 'logout-form', 'method' => 'POST', 'route' => 'logout']) !!}
                                {!! Form::close() !!}
                            </li>
                            <li><a href="{{ route('get.profile') }}">Profile</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>


        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
