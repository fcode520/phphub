@extends('layouts.account_right')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/style.css')}}
    {{HTML::style('assets/onework_css/layout.css')}}
    {{HTML::style('assets/onework_css/renzheng.css')}}
@stop

@section('content')
    @include('register.editresumes')
@stop

@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.languages.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}
    {{HTML::script(cdn('assets/onework_js/myapp.js'))}}

@stop