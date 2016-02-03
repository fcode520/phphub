@extends('layouts.default')

@section('css')
 {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
    <div class="container register_ok">
      <div class="email-ok text-center">
        <h2>邮箱验证</h2>
        <p>感谢您的注册！激活链接已经发到您的邮箱</p>
        <p class="a" >{{$user->email}}</p>
        <p>点击邮件里的链接即可激活账户</p>
        <p class="b">还没收到确认邮件？尝试到广告邮件，垃圾邮件目录里找找看</p>
        {{HTML::link('#','再次发送确认邮件',array('class'=>'send_valid_mail','onclick'=>'vaild_mail('.$user->id.')'))}}
                <meta name="csrf-token" content="{{ csrf_token() }}" />
      </div>
    <div class="container">
@stop
@section('scripts')
    {{ HTML::script('assets/onework_js/Register_ajax.js') }}
@stop