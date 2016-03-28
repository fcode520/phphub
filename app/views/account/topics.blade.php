@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')
                <div class="col-xs-9 modify-article">
                <div class="clearfix"></div>
              <p class="message-num">
                <span>我的文章</span>
                </p>


                          <div class="exchange-hot mart0">
                            <div class="hot-con new-hot-con">
@include('usersinfo.userstopics')
  <div class="pull-right add-padding-vertically">
  {{ $topics->links('layouts.partials.pagination'); }}
  </div>
                    </div>
                    </div>
                </div>
    <!--个人 文章 end-->

@stop

@section('scripts')
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
{{--{{HTML::script('assets/onework_js/myapp.js')}}--}}
<script>
    $('#flash-overlay-modal').modal();
</script>
@stop