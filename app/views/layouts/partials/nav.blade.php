
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
                <li class="{{ (Request::is('topics*') ||Request::is('/')? ' act' : '') }}"><a id="" href="{{ route('topics.index') }}" >{{ lang('Topics') }}</a></li>
                <li class="{{ (Request::is('nodes/6') ? ' act' : '') }}"><a id="" href="{{ route('nodes.show', 6) }}" >{{ lang('Jobs') }}</a></li>
                <li class="{{ (Request::is('nodes/8') ? ' act' : '') }}"><a id="" href="{{ route('nodes.show', 8) }} ">{{ lang('Cooperate') }}</a></li>
                <li class="{{ (Request::is('nodes/7') ? ' act' : '') }}"><a href="{{ route('nodes.show', 7) }}">{{ lang('Team') }}</a></li>
                <li class="{{ (Request::is('wiki*') ? ' act' : '') }}"><a href="{{ route('wiki') }}">{{ lang('Wiki') }}</a></li>
                <li class="{{ (Request::is('about*') ? ' act' : '') }}"><a href="{{ route('about') }}">{{ lang('About') }}</a></li>
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
                <!-- 用户头像区域 -->
                        <a href="{{route('ac_notify')}}">
                        <img class="" alt="{{{ $currentUser->username }}}" src="{{ $currentUser->present()->gravatar }}" style="width:30px;height:30px;" />

                        </a>
                        <a class="{{route('account')}}">{{ $currentUser->username }} </a>
                        <i class="red-dot"></i>
                        <i class="tiangle"></i>
                        <div class="header-info">
                          <ul>
                                <li><a href="{{route('topics.create')}}">发布话题</a></li>
                                <li><a href="{{route('account')}}">个人资料</a></li>
                                <li><a href="{{route('ac_notify')}}">消息中心</a></li>
                                <li><a href="{{route('ac_topices')}}">我的文章</a></li>
                                <li><a href="{{route('logout') }}">退出</a></li>
                          </ul>
                          <p></p>
                        </div>

                        {{--<a class="break" href="{{ route('notifications.index') }}" class="text-warning">--}}
                      {{--<span class="badge badge-{{ $currentUser->notification_count > 0 ? 'important' : 'fade'; }}" id="notification-count">--}}
                          {{--{{ $currentUser->notification_count }}--}}
                      {{--</span>--}}
                        {{--</a>--}}
                        {{--<a class="break" href="{{ route('account') }}">--}}
                            {{--<i class="fa fa-user"></i> {{{ $currentUser->username }}}--}}
                        {{--</a>--}}

                        {{--<a  class="break" href="{{ URL::route('logout') }}" >--}}
                            {{--<i class="fa fa-sign-out"></i> {{ lang('Logout') }}--}}
                        {{--</a>--}}

                @else
                    <a  href="{{ URL::route('ow_login') }}" class="login-a" id="login-btn">
                        {{ lang('Login') }}
                    </a>
                    <a  href="{{ URL::route('ow_register') }}" class="btn btn-success" id="login-btn">
                        {{ lang('Register') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>