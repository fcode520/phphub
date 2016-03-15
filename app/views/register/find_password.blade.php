@extends('layouts.default')


@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')

{{Form::open(array('class'=>'login form-horizontal bv-form','id'=>'login','novalidate'=>'novalidate'))}}
<div class="login_box">
    <p class="title">通过绑定邮箱进行密码找回。</p>
    <div class="form-group register-context has-feedback">
    {{Form::text('email',null,array('name'=>'email','id'=>'email','placeholder'=>"请输入你的注册绑定邮箱"))}}
    </div>
    {{ Form::submit('找回密码',array('class'=>'btn btn-large btn-success btn-block')) }}

</div>
{{Form::close()}}
@stop

{{--@section('scripts')--}}
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/myapp.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/bootstrapValidator.min.js'))}}--}}


{{--@stop--}}