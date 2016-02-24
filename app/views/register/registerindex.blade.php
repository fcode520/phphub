@extends('layouts.default')

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
        {{--错误信息框--}}
<div class="container">
    @if(Session::has('message'))
        @foreach (Session::get('message')->all() as $message)
        <p class="alert">{{$message}}</p>
        @endforeach
    @endif
</div>

{{Form::open(array('url'=>'/ow_register','class'=>'register content form-horizontal bv-form','novalidate'=>'novalidate'))}}
<div class="register_box">
    <p class="title">会员注册</p>
    <div class="form-group register-context has-feedback">
    {{Form::text('email',null,array('name'=>'email','id'=>'email','placeholder'=>"邮箱"))}}
    </div>
     <div class="form-group register-context has-feedback">
    {{Form::text('username',null,array('name'=>'username','id'=>'username','placeholder'=>"昵称"))}}
    </div>
    <div class="form-group register-context has-feedback">
  <input type="password" class="form-control " name="password" data-bv-field="password" placeholder="密码">
 </div>
    <div class="form-group register-context has-feedback">
    <input type="password" class="form-control" name="password_confirmation" data-bv-field="password" placeholder="确认密码">
     </div>

    {{ Form::submit('注册',array('class'=>'btn btn-large btn-success btn-block','id'=>'register_button')) }}
</div>
{{Form::close()}}

@stop

@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}
    {{HTML::script(cdn('assets/onework_js/myapp.js'))}}
    {{HTML::script(cdn('assets/onework_js/bootstrapValidator.min.js'))}}

@stop