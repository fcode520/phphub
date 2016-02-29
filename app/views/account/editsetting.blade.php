@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('content')
  @include('account.partials.leftnav')
  @include('register.resume')
@stop

{{--@section('scripts')--}}
    {{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.min.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.languages.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/myapp.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.validate.min.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/bootstrapValidator.min.js'))}}--}}
{{--@stop--}}