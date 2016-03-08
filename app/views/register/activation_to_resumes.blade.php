@extends('layouts.default')


@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
	<!--激活成功-->
	<div class="container">
		<div class="activate-success clearfix">
			<h2>恭喜您，激活成功！</h2>
			<a class="btn btn-success" href="{{route('editsetting')}}">完善资料</a><br>
			<a href="{{route('home')}}">返回首页</a>
		</div>
	</div>
@stop
{{--@section('scripts')--}}
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
    {{--{{ HTML::script('assets/onework_js/Register_ajax.js') }}--}}

{{--@stop--}}