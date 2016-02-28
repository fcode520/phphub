@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')
@include('account.setting')
@stop

{{--@section('scripts')--}}
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
{{--{{HTML::script(cdn('assets/onework_js/myapp.js'))}}--}}
{{--@stop--}}