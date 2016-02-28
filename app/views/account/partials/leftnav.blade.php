{{--<div class="left-nav">--}}
    {{--<div class="left-nav-logo text-center"><a href="{{route('account')}}"></a>ONEWORK</div>--}}
    {{--<ul>--}}
        {{--<li><span data-text="消息" class="a" data-src="/account/"></span></li>--}}
        {{--<li><span data-text="项目" class="b" data-src="project"></span></li>--}}
        {{--<li><span data-text="文章" class="c" data-src="/account/topics"></span></li>--}}
        {{--<li><span data-text="团队" class="d" data-src="team"></span></li>--}}
        {{--<li><span data-text="设置" class="e" data-src="/account/personalsettings"></span></li>--}}
        {{--<a  onclick="gotourl('{{route('account')}}')"  style="color: rgb(255, 255, 255);">&nbsp;消息</a>--}}
        {{--<a  onclick="gotourl('{{route('ac_topices')}}')" style="color: rgb(255, 255, 255);">&nbsp;文章</a>--}}
        {{--<a  onclick="gotourl('{{route('ac_setting')}}')"  style="color: rgb(255, 255, 255); ">&nbsp;设置</a>--}}
    {{--</ul>--}}

    {{--<div class="nav-title-tip"><span class="glyphicon glyphicon-triangle-left"></span><i></i></div>--}}
{{--</div>--}}
			<div class="col-sm-3 my-set-center">
				<ul>
				    {{--<li class="act"><a href="{{route('account')}}">个人资料</a></li>--}}
				    <li class="{{ (Request::is('account')? 'act' : '1') }}"><a href="{{route('account')}}">个人资料</a></li>
					<li class="{{ (Request::is('account/topics')? 'act' : '1') }}"><a href="{{route('ac_topices')}}">文章</a></li>
                    <li class="{{ (Request::is('account/notify')? 'act' : '1') }}"><a href="{{route('ac_notify')}}">消息</a></li>
					{{--<li><a href="#">发送站内信</a></li>--}}
				</ul>
				<span></span>
			</div>