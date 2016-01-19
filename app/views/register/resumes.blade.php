@extends('layouts.default')

@section('css')
{{--    <link rel="stylesheet" href="{{cdn('assets/onework_css/register.css')}}">--}}
    {{HTML::style('assets/onework_css/renzheng.css')}}
@stop

@section('title')
{{ lang('Newly Registered User List') }}_@parent
@stop

@section('content')
    <div class="renzheng">
    <p class="title"><span>完善资料</span><span>填写详细个人信息，加入人才库</span></p>

        {{Form::open(array('url'=>'/resumes','class'=>'content','id'=>'renzhengform'))}}

        <div class="header">
            @if($user->avatar)
                {{HTML::image($user->present()->gravatar,'a picture',array('class'=>'header'))}}
            @else
                {{HTML::image(cdn('assets/images/register/addheader.png'),'a picture',array('class'=>'header'))}}
            @endif
            <input type="file" name="uploadImg" id="uploadImg" onchange="">
            <span>添加头像</span>
        </div>
        <div class="input">
          {{--<input type="text" name="email" id="" placeholder="邮箱">--}}
            <div class="row">
                {{Form::select('sex',[
                ''=>'性别',
                '0'=>'男',
                '1'=>'女',
                '2'=>'保密'])}}
                {{Form::select('skill',[
               ''=>'技能',
               '0'=>'C++',
               '1'=>'PHP',
               '2'=>'ios',
               '3'=>'Andriod',
               '4'=>'web前端'
               ])}}
                {{Form::select('profession',[
               ''=>'职业',
               '0'=>'全职远程工作者',
               '1'=>'兼职远程工作者',
               '2'=>'非远程工作者'])}}

            </div>
            {{Form::text('qqnumber',null,array('placeholder'=>'QQ'))}}
            {{Form::text('Blog',null,array('placeholder'=>'博客/github'))}}

            <div class="row">
                <select name="sheng" id="">
                    <option value="">省</option>
                    <option value="1">黑龙江</option>
                    <option value="2">吉林</option>
                    <option value="3">辽宁</option>
                </select>
                <select name="shi" id="">
                    <option value="">市</option>
                    <option value="2">沈阳</option>
                    <option value="1">抚顺</option>
                </select>
                <select name="diqu" id="">
                    <option value="">地区</option>
                    <option value="1">地区1</option>
                    <option value="2">地区2</option>
                </select>
            </div>

            {{Form::textarea('summery',null,['placeholder'=>'个人简介'])}}
            {{Form::textarea('experience',null,['placeholder'=>'技术经验'])}}
            <p class="subtitle">项目经验</p>
            <div class="row2">
                <input type="text" name="xiangmumingchegn" id="" placeholder="项目名称">
                <input type="text" name="danrenzhiwu" id="" placeholder="担任职务">
            </div>
            <div class="row2">
                <select name="starttime" id="">
                    <option>1998-01-01</option>
                    <option value="">1998-01-01</option>
                    <option value="2">1998-01-01</option>
                    <option value="3">1998-01-01</option>
                </select>
                <select name="endtime" id="">
                    <option value="">1998-01-01</option>
                    <option value="2">1998-01-01</option>
                    <option value="3">1998-01-01</option>
                </select>
            </div>

            <input type="text" name="zhanshi" id="" placeholder="展示链接">
            <textarea name="xiangmujingli" id="" placeholder="项目经历"></textarea>
            <p class="addjingyan">+添加一个项目经验</p>
            {{Form::submit('保存',array('id'=>'mysubmit','class'=>'mysubmit'))}}
        </div>
    {{Form::close()}}
    </div>

@stop

@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery-2.14.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/bootstrap.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.validate.min.js'))}}
@stop