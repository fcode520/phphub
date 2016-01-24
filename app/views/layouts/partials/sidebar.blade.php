@if(isset($currentUser))
<div class="col-sm-3 exchange-side">
      <div class="personal-info">
        <div class="personal-photo"><img src='{{$currentUser->present()->gravatar}}'></div>
        <div class="personal-name">
          <h2>MONSTER</h2>
          <p><span>关注:10&nbsp;&nbsp;</span><span>粉丝:20</span></p>
        </div>
        <div class="clearfix"></div>
        <div class="three-info clearfix">
          <div><span>{{$currentUser->topic_count}}</span><p>我的文章</p></div>
          <div><span>{{$currentUser->reply_count}}</span><p>我的评论</p></div>
        </div>
        @if ($currentUser->notification_count>0)
        <a href="{{ route('notifications.index') }}" class="text-warning">
        <p class="personal-comment">{{ $currentUser->notification_count }}条未读评论<span>{{ $currentUser->notification_count }}</span></p>
        </a>
        @endif
        <p class="a"><a href="#">个人中心</a></p>
        <p class="b"><a href="{{ isset($node) ? URL::route('topics.create', ['node_id' => $node->id]) : URL::route('topics.create') ; }}">＋发布新话题</a></p>
        <p class="c"><a href="#">认证账号，加入人才库</a></p>
      </div>
      {{--<div class="side_banner">--}}
        {{--<img src="images/side_banner.jpg">--}}
      {{--</div>--}}
      @if(!Request::is('topics/*'))
       <div class="panel panel-default corner-radius">
          <div class="panel-heading text-center">
            <h3 class="panel-title">{{ lang('Site Status') }}</h3>
          </div>
          <div class="panel-body">
            <ul>
              <li>{{ lang('Total User') }}: {{ $siteStat->user_count }} </li>
              <li>{{ lang('Total Topic') }}: {{ $siteStat->topic_count }} </li>
              <li>{{ lang('Total Reply') }}: {{ $siteStat->reply_count }} </li>
            </ul>
          </div>
        </div>
        @endif
    </div>
</div>
@else
<div class="col-sm-3 exchange-side">
<div class="personal-info">
 <p class="b"><a href="{{URL::route('ow_login')}}">登录</a></p>
 <p class="b"><a href="{{URL::route('ow_register')}}">注册</a></p>
 </div>
 </div>
@endif