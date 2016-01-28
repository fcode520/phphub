@extends('layouts.default')

@section('title')
{{ '测试页面' }} @parent
@stop

@section('css')
    {{--{{HTML::style('assets/onework_css/layout.css')}}--}}
    <link rel="stylesheet" href="{{cdn('assets/onework_css/layout.css')}}">
@stop

@section('content')
<div> 测试页面</div>
@stop
<!--交流页面主要内容end-->
@include('layouts.partials.sidebar')
@stop
