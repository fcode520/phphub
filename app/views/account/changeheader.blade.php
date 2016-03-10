@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')
<div class="col-xs-9 ">
@include('account.partials.TopSettingNav')
<div class="clearfix"></div>

    <div class="container attestation">
        <p class="title"><span>修改头像</span>
            <span>修改 头像 让你与众不同！</span>
@include('account.partials.avatar')

        </p>
    </div>
</div>
@stop

@section('scripts')
{{HTML::script(cdn('assets/js/jquery.Jcrop.min.js'))}}
@stop