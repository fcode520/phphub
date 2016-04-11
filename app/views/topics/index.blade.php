@extends('layouts.default')

@section('title')
{{ lang('Topic List') }} @parent
@stop

@section('css')
    {{--{{HTML::style('assets/onework_css/layout.css')}}--}}
    <link rel="stylesheet" href="{{cdn('assets/onework_css/layout.css')}}">
@stop

@section('content')
    {{--@if(isset($currentUser))--}}
         {{--@if($currentUser->status==0)--}}
      {{--<div class="container alert alert-danger">--}}
          {{--{{ '请激活当前用户' }}--}}
          {{--<a href="{{route('SendActivationEmail')}}">点击重新发送激活邮件</a>--}}
      {{--</div>--}}
         {{--@endif--}}
    {{--@endif--}}


<!--交流页面主要内容begin-->

 <div class="col-sm-9 exchange">
      <div class="exchange-head">
        <ul>
          <li class={{(Request::is('topics*') ||Request::is('/')? ' act' : '') }}><a href="{{ route('topics.index') }}">全部</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li class={{(Request::is('nodes/5') ? ' act' : '') }}><a href="{{ route('nodes.show', 5)}}">寻找项目</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li class={{(Request::is('nodes/6') ? ' act' : '') }}><a href="{{ route('nodes.show', 6)}}">寻求工作</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li class={{(Request::is('nodes/7') ? ' act' : '') }}><a href="{{ route('nodes.show', 7)}}">远程团队</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li class={{(Request::is('nodes/8') ? ' act' : '') }}><a href="{{ route('nodes.show', 8)}}">提升技能</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li class={{(Request::is('nodes/9') ? ' act' : '') }}><a href="{{ route('nodes.show', 9)}}">每周必读</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li class={{(Request::is('nodes/13') ? ' act' : '') }}><a href="{{ route('nodes.show', 13)}}">我要吐槽</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
        </ul>
      </div>
      <div class="exchange-hot">
          @if (isset($node))
                  <h2 class="hot-title">{{ lang('Current Node') }}: {{{ $node->name }}}</h2>
          @else
                  <h2 class="hot-title">全部文章</h2>
          @endif

        <div class="hot-con">
             @include('topics.partials.topics')
        </div>
        <div class="hot-footer text-right">
                        <!-- Pager -->
         {{ $topics->appends(Request::except('page', '_pjax'))->links('layouts.partials.pagination'); }}
        </div>
      </div>

</div>
<!--交流页面主要内容end-->
@include('layouts.partials.sidebar')
@stop

{{--@section('scripts')--}}
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
{{--{{HTML::script('assets/onework_js/myapp.js')}}--}}
{{--@stop--}}