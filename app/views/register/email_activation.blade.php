@extends('layouts.default')

@section('css')
{{--    <link rel="stylesheet" href="{{cdn('assets/onework_css/register.css')}}">--}}
    {{HTML::style('assets/onework_css/register.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')

        <!-- 注册 -->
    <div class="register_ok">
        <p>感谢您的注册，激活链接已经发送到您的邮箱</p>
        <p>{{$user->email}}</p>
        <p>点击邮件里的连接即可激活账户</p>
        <p></p>
        <p>还没有收到邮件？</p>

        {{--{{HTML::link('send_valid_mail/'.$user->id,'再次发送确认邮件',array('class'=>'send_valid_mail'))}}--}}
        {{HTML::link('#','再次发送确认邮件',array('class'=>'send_valid_mail','onclick'=>'vaild_mail('.$user->id.')'))}}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </div>

@stop
@section('scripts')
    {{ HTML::script('assets/onework_js/Register_ajax.js') }}
@stop