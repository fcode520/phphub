@extends('layouts.default')

@section('css')

 {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
<div class="register_ok">
  <p>恭喜你，激活成功，请完善个人资料</p>
  <a href="{{route('EditResume')}}">进一步完善</a>
</div>
@stop
{{--@section('scripts')--}}
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
    {{--{{ HTML::script('assets/onework_js/Register_ajax.js') }}--}}

{{--@stop--}}