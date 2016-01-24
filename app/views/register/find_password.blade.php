@extends('layouts.default')

@section('css')
    {{HTML::style('assets/onework_css/register.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    </div>
    {{Form::open(array('class'=>'mimazhaohui text-center'))}}
        <p>通过绑定邮箱进行密码找回。请输入你的注册绑定邮箱</p>
        <p><span>邮箱</span>
            {{Form::email('email','',array('placeholder'=>'Email'))}}
        </p>
        <div class="clearfix"></div>
    {{Form::submit(" 提交",array('class'=>'btn btn-success'))}}
    {{Form::close()}}
@stop

@section('scripts')


@stop