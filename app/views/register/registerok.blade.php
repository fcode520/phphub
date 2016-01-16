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
        <p>注册成功，请完善个人资料</p>
        {{--<a href="{{route('ow_register_ziliao')}}">进一步完善</a>--}}
        {{HTML::link('ow_retister_ziliao','进一步完善')}}
    </div>


@stop
