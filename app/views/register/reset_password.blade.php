@extends('layouts.default')

@section('css')
     {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
    {{Form::open(array('class'=>'mimaxiugai  text-center'))}}
    <p>邮件链接打开后页面。直接修改新密码</p>
    <input readonly="readonly" name="email" type="email" placeholder="{{$email}}" value="{{$email}}">
    {{Form::hidden('token',$token)}}
    {{Form::password('password',array('placeholder'=>"新密码"))}}
    {{Form::password('password_confirmation',array('placeholder'=>"确认密码"))}}
    <div class="clearfix"></div>
    {{Form::submit('确认',array('class'=>'btn btn-success'))}}
    {{Form::close()}}

@stop

