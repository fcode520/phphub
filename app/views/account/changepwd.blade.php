@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')

    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')
                <div class="col-xs-9 m">


                    @include('account.partials.TopSettingNav')
                    <div class="clearfix"></div>
    <div class="change-pwd">

         {{Form::open(array('url'=>'/account/changepassword','novalidate'=>'novalidate','method' => 'POST','class'=>'passwordfrom content form-horizontal bv-form','id'=>'changepwd'))}}
                                    <div class="form-group has-feedback change-pwd-con">
                                    <input type="password" class="form-control" name="old_pwd" data-bv-field="pwd" placeholder="旧密码" data-bv-notempty data-bv-notempty-message="内容不能为空">
                                    </div>
                                    <div class="form-group has-feedback change-pwd-con"><input type="password" class="form-control" name="password" data-bv-field="password" placeholder="新密码"></div>
                                    <div class="form-group has-feedback change-pwd-con"><input type="password" class="form-control" name="confirmPassword" data-bv-field="password" placeholder="确认密码"></div>
                                    {{Form::button('确定',array('id'=>'mysubmit','class'=>'btn btn-success change-submint'))}}
         {{Form::close()}}
   </div>
    						</div>

@stop

{{--@section('scripts')--}}
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.min.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.languages.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/myapp.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/bootstrapValidator.min.js'))}}--}}
    {{--{{HTML::script(cdn('assets/onework_js/form_ajax.js'))}}--}}

{{--@stop--}}