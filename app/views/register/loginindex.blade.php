@extends('layouts.default')

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop
@section('css')
 {{HTML::style('assets/onework_css/layout.css')}}
@stop
@section('content')

        {{--错误信息框--}}
<div class="container">
    @if(Session::has('message'))
        <p class="alert">{{ Session::get('message') }}</p>
    @endif
</div>
<!-- 登录框-->
{{Form::open(array('url'=>'/ow_login','class'=>'login content form-horizontal bv-form','id'=>'login','novalidate'=>'novalidate'))}}
<div class="login_box">
    <p class="title">会员登陆</p>
    <div class="form-group register-context has-feedback">
    {{Form::text('username',null,array('name'=>'username','id'=>'username','placeholder'=>"用户名"))}}
    </div>
    <div class="form-group register-context has-feedback">
    {{ Form::password('password', array('name'=>'password','class'=>'form-control','id'=>'password','placeholder'=>"密码")) }}
    </div>
    {{ Form::submit('登录',array('class'=>'btn btn-large btn-success btn-block')) }}

</div>
       <div class="login_about">
           <p>
           <a href="{{route("ow_register")}}">注册帐号</a>
           <a href="/password/remind">忘记密码</a>
           </p>
       </div>
{{Form::close()}}


        {{--<form class="login" id="login">--}}
        {{--<div class="login_box">--}}
        {{--<p class="title">会员登陆</p>--}}
        {{--<input type="text" name="username" id="username" placeholder="用户名">--}}
        {{--<input type="password" name="password" id="password" placeholder="密码">--}}
        {{--<button>登录</button>--}}
        {{--</div>--}}
        {{--<div class="login_about">--}}
        {{--<p><a href="register.html">注册帐号</a><a href="forget.html">忘记密码</a></p>--}}
        {{--<ul class="other_login">--}}
        {{--<li>--}}
        {{--<a href="javascript:;">--}}
        {{--<img src={{cdn('assets/images/login/login_logo.jpg')}}>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="javascript:;">--}}
        {{--<img src={{cdn('assets/images/login/login_logo.jpg')}}>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="javascript:;">--}}
        {{--<img src={{cdn('assets/images/login/login_logo.jpg')}}>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--<p class="ps">第三方帐号登陆</p>--}}
        {{--</div>--}}
        {{--</form>--}}
@stop
@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}
    {{HTML::script(cdn('assets/onework_js/myapp.js'))}}
    {{HTML::script(cdn('assets/onework_js/bootstrapValidator.min.js'))}}

@stop