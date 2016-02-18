@if(isset($currentUser))
<div class="col-sm-3 exchange-side">
      <div class="personal-info">
        <div class="personal-photo"><img style="width:65px; height:65px;" src='{{$currentUser->present()->gravatar}}'></div>
        <div class="personal-name">
          <h2>MONSTER</h2>
          <p><span>关注:10&nbsp;&nbsp;</span><span>粉丝:20</span></p>
        </div>
        <div class="clearfix"></div>
        <div class="three-info clearfix">
        <ul>
        <li><span>{{$currentUser->topic_count}}</span><p>我的文章</p></li>
        <li><span>{{$currentUser->reply_count}}</span><p>我的评论</p></li>
        <li><span>{{$currentUser->reply_count}}</span><p>收到评论</p></li>
        </ul>
        </div>
        @if ($currentUser->notification_count>0)
        <a href="{{ route('notifications.index') }}" class="text-warning">
        <p class="personal-comment">{{ $currentUser->notification_count }}条未读评论<span>{{ $currentUser->notification_count }}</span></p>
        </a>
        @endif
        <p class="a"><a href="/account">个人中心</a></p>
        <p class="b"><a href="{{ isset($node) ? URL::route('topics.create', ['node_id' => $node->id]) : URL::route('topics.create') ; }}">＋发布新话题</a></p>
        <p class="c"><a href="#">认证账号，加入人才库</a></p>
      </div>
        <div class="side_banner">
              <img src="{{cdn('assets/images/side_banner.jpg')}}">
        </div>
      {{--@if(!Request::is('topics/*'))--}}
       {{--<div class="panel panel-default corner-radius">--}}
          {{--<div class="panel-heading text-center">--}}
            {{--<h3 class="panel-title">{{ lang('Site Status') }}</h3>--}}
          {{--</div>--}}
          {{--<div class="panel-body">--}}
            {{--<ul>--}}
              {{--<li>{{ lang('Total User') }}: {{ $siteStat->user_count }} </li>--}}
              {{--<li>{{ lang('Total Topic') }}: {{ $siteStat->topic_count }} </li>--}}
              {{--<li>{{ lang('Total Reply') }}: {{ $siteStat->reply_count }} </li>--}}
            {{--</ul>--}}
          {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}
    </div>
</div>
@else

<div class="col-sm-3 exchange-side">
      <div class="list-info">
        <div class="unit-a clearfix">
            <ul>
              <li><span>1120</span><p>远程工作者</p></li>
              <li><span>20</span><p>认证会员</p></li>
              <li><span>120</span><p>交流文章</p></li>
            </ul>
        </div>
        <a href="{{ isset($node) ? URL::route('topics.create', ['node_id' => $node->id]) : URL::route('topics.create') ; }}" class="unit-b btn btn-success">+发布新话题</a>
        <div class="unit-c">
          <ul>
            <li><span>热门文章</span></li><li><span>最新招聘</span></li><li><span>外包项目</span></li>
          </ul>
          <div class="line"></div>
        </div>
        <div class="unit-d act">
          <ul>
            <li>
              <i></i>
              <a href="#">热门文章 标题</a>
              <p><a href="#">卡卡西前辈</a><span>2015-11-11 00:17</span></p>
            </li>
          </ul>
        </div>
        <div class="unit-d">
          <ul>
            <li>
              <i></i>
              <a href="#">最新招聘 标题</a>
              <p><a href="#">卡卡西前辈</a><span>2015-11-11 00:17</span></p>
            </li>

          </ul>
        </div>
        <div class="unit-d">
          <ul>
            <li>
              <i></i>
              <a href="#">外包项目</a>
              <p><a href="#">卡卡西前辈</a><span>2015-11-11 00:17</span></p>
            </li>
          </ul>
        </div>
      </div>
    </div>




















@endif