
<!-- 导航条 -->
<nav class="navbar navbar-default">
    <div class="container">

        <!-- logo区域 -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">手机导航按钮</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="navbar-brand" class="navbar-brand" href="/"><img src={{cdn('assets/images/logo.png')}}></a>
        </div>

        <!-- 导航按钮区域 -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ (Request::is('topics*') ||Request::is('/')? ' active' : '') }}"><a href="{{ route('topics.index') }}">{{ lang('Topics') }}</a></li>
                <li class="{{ (Request::is('nodes/40') ? ' active' : '') }}"><a href="{{ route('nodes.show', 40) }}">{{ lang('Jobs') }}</a></li>
                <li class="{{ (Request::is('Cooperate*') ? ' active' : '') }}"><a href="{{ route('topics.index', 40) }}">{{ lang('Cooperate') }}</a></li>
                <li class="{{ (Request::is('team*') ? ' active' : '') }}"><a href="{{ route('topics.index') }}">{{ lang('Team') }}</a></li>
                <li class="{{ (Request::is('wiki*') ? ' active' : '') }}"><a href="{{ route('wiki') }}">{{ lang('Wiki') }}</a></li>
                <li class="{{ (Request::is('about*') ? ' active' : '') }}"><a href="{{ route('about') }}">{{ lang('About') }}</a></li>
            </ul>

            <!-- 导航按钮区域 -->
            {{ Form::open(['route'=>'search', 'method'=>'get', 'class'=>'navbar-form navbar-left hidden-sm', 'target'=>'_blank','role'=>'search']) }}
            <div class="form-group">
                {{ Form::text('q', null, ['class' => 'form-control ', 'placeholder' => lang('Search'),'placeholder'=>'Search']) }}
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span></button>
            {{ Form::close() }}

                    <!-- 搜索框表单 -->
            <div class="header text-right">
                @if (Auth::check())
                    {{--<li>--}}
                        <a href="{{ route('notifications.index') }}" class="text-warning">
                      <span class="badge badge-{{ $currentUser->notification_count > 0 ? 'important' : 'fade'; }}" id="notification-count">
                          {{ $currentUser->notification_count }}
                      </span>
                        </a>
                    {{--</li>--}}
                    {{--<li>--}}
                        <a href="{{ route('users.show', $currentUser->id) }}">
                            <i class="fa fa-user"></i> {{{ $currentUser->username }}}
                        </a>
                    {{--</li>--}}
                    {{--<li>--}}
                        <a class="button" href="{{ URL::route('logout') }}" >
                            <i class="fa fa-sign-out"></i> {{ lang('Logout') }}
                        </a>
                    {{--</li>--}}
                @else
                    <a href="{{ URL::route('ow_login') }}" class="btn btn-success" id="login-btn">
                        {{--<i class="fa fa-github-alt"></i>--}}
                        {{ lang('Login') }}
                    </a>
                    <a href="{{ URL::route('ow_register') }}" class="btn btn-success" id="login-btn">
                        {{--<i class="fa fa-github-alt"></i>--}}
                        {{ lang('Register') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>