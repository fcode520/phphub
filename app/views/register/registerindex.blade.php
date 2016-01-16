@extends('layouts.default')

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')

        <!-- 注册 -->



{{Form::open(array('url'=>'/ow_register','class'=>'register'))}}
<div class="register_box">
    <p class="title">会员注册</p>
    {{Form::text('email',null,array('name'=>'email','id'=>'email','placeholder'=>"邮箱"))}}
    {{Form::text('username',null,array('name'=>'username','id'=>'username','placeholder'=>"昵称"))}}

    {{Form::password('password',null,array('name'=>'password','id'=>'password','placeholder'=>"密码"))}}
    {{Form::password('password',null,array('name'=>'confirm_password','id'=>'confirm_password','placeholder'=>"确认密码"))}}
    {{ Form::submit('注册',array('class'=>'btn btn-large btn-success btn-block')) }}
</div>
{{Form::close()}}


@stop
