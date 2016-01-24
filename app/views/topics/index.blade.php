@extends('layouts.default')

@section('title')
{{ lang('Topic List') }} @parent
@stop

@section('css')
    {{--{{HTML::style('assets/onework_css/layout.css')}}--}}
    <link rel="stylesheet" href="{{cdn('assets/onework_css/layout.css')}}">
@stop

@section('content')
@if(isset($currentUser))
@if($currentUser->status==0)
      <div class="alert alert-danger">
          {{ '请激活当前用户' }}
      </div>
      @endif
      @endif
<!--交流页面主要内容begin-->
  <div class="row">
    <div class="col-sm-9 exchange">
      <div class="exchange-head">
        <ul>
          <li><a href="#">全部</a></li>
          <li><a href="#">寻求工作</a></li>
          <li><a href="#">团队招募</a></li>
          <li><a href="#">外包</a></li>
          <li><a href="#">寻求合伙人</a></li>
        </ul>
      </div>

      <div class="exchange-hot">
          @if (isset($node))
                  <h2 class="pull-left panel-title">{{ lang('Current Node') }}: {{{ $node->name }}}</h2>
          @else
                  <h2 class="hot-title">全部文章</h2>
          @endif
                {{--@include('topics.partials.filter')--}}

        <div class="hot-con">
             @include('topics.partials.topics')
        </div>
        <div class="hot-footer text-right">
                        <!-- Pager -->
         {{ $topics->appends(Request::except('page', '_pjax'))->links(); }}
        </div>
      </div>


    </div>

    {{--<div class="col-sm-3 exchange-side">--}}
      {{--<div class="personal-info">--}}
        {{--<div class="personal-photo"><img src="images/personal_photo.png"></div>--}}
        {{--<div class="personal-name">--}}
          {{--<h2>MONSTER</h2>--}}
          {{--<p><span>关注:10&nbsp;&nbsp;</span><span>粉丝:20</span></p>--}}
        {{--</div>--}}
        {{--<div class="clearfix"></div>--}}
        {{--<div class="three-info clearfix">--}}
          {{--<div><span>20</span><p>我的文章</p></div>--}}
          {{--<div><span>20</span><p>文章收藏</p></div>--}}
          {{--<div><span>120</span><p>收到评论</p></div>--}}
        {{--</div>--}}
        {{--<p class="personal-comment">20条未读评论<span>20</span></p>--}}
        {{--<p class="a"><a href="#">个人中心</a></p>--}}
        {{--<p class="b"><a href="#">＋发布新话题</a></p>--}}
        {{--<p class="c"><a href="#">认证账号，加入人才库</a></p>--}}
      {{--</div>--}}
      {{--<div class="side_banner">--}}
        {{--<img src="images/side_banner.jpg">--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}


<!--交流页面主要内容end-->
@include('layouts.partials.sidebar')
@stop
