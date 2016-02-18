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

 <div class="col-sm-9 exchange">
      <div class="exchange-head">
        <ul>
          <li class="act"><a href="#">全部</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li><a href="#">寻求工作</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li><a href="#">团队招募</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li><a href="#">外包</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
          <li><a href="#">寻求合伙人</a><span class="glyphicon glyphicon-triangle-bottom"></span></li>
        </ul>
      </div>
      <div class="exchange-hot">
          @if (isset($node))
                  <h2 class="pull-left panel-title">{{ lang('Current Node') }}: {{{ $node->name }}}</h2>
          @else
                  <h2 class="hot-title">全部文章</h2>
          @endif

        <div class="hot-con">
             @include('topics.partials.topics')
        </div>
        <div class="hot-footer text-right">
                        <!-- Pager -->
         {{ $topics->appends(Request::except('page', '_pjax'))->links(); }}
        </div>
      </div>

</div>
<!--交流页面主要内容end-->
@include('layouts.partials.sidebar')
@stop

@section('scripts')
{{HTML::script('assets/onework_js/myapp.js')}}
@stop