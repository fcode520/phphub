@extends('layouts.default')

@section('css')
    {{HTML::style('assets/onework_css/renzheng.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
    <div class="renzheng">
    <p class="title"><span>完善资料</span><span>填写详细个人信息，加入人才库</span></p>
        @include('register.resume')
    </div>

@stop

@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.languages.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}
    {{HTML::script(cdn('assets/onework_js/myapp.js'))}}

@stop