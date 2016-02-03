@extends('layouts.account')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
<div id="rightFrame">
<iframe src="{{route('ac_notify')}}" name="iframe_right" id="iframe_right"></iframe>
</div>
@stop

@section('scripts')
{{HTML::script('assets/onework_js/myapp.js')}}
@stop