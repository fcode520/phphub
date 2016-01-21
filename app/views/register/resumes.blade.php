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

        {{Form::open(array('url'=>'/EditResume','class'=>'content','id'=>'renzhengform'))}}

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
            {{Form::text('qqnumber',null,array('placeholder'=>'QQ','id'=>'qq'))}}
            {{Form::text('Blog',null,array('placeholder'=>'博客/github'))}}

            <div class="row" data-toggle="distpicker">
                <select name="sheng" id="">
                </select>
                <select name="shi" id="">
                </select>
                <select name="diqu" id="">

                </select>
            </div>

            {{Form::textarea('summery',null,['placeholder'=>'个人简介'])}}
            {{Form::textarea('experience',null,['placeholder'=>'技术经验'])}}
            <div class="project-info">
                <div class="one-project">
                    <p class="subtitle">项目经验</p>
                    <div class="row2">
                        <input type="text" name="ProjectName[ ]" id="ProjectName" placeholder="项目名称">
                        <input type="text" name="ProjectPosition[ ]" id="ProjectPosition" placeholder="担任职务">
                    </div>
                    <div class="row2">
                        <input id="starttime_id" name="starttime[]" type="text" class ="timeclass" data-position="bottom">
                        <input id="endtime_id" name="endtime[]" type="text" class ="timeclass" data-position="bottom">
                    </div>
                    <input type="text" name="ProjectUrl[ ]" id="" placeholder="展示链接">
                    <textarea name = "Projectexperience[ ]" id="" placeholder="项目经历"></textarea>
                </div>
            </div>
            <p class="addjingyan">+添加一个项目经验</p>
            {{Form::hidden('projectNum','1',array('id'=>'projectNum'))}}
            {{Form::submit('保存',array('id'=>'mysubmit','class'=>'mysubmit'))}}
        </div>
    {{Form::close()}}
    </div>

@stop

@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery-2.14.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/bootstrap.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.validate.min.js'))}}

    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.languages.js'))}}
    {{HTML::script(cdn('assets/onework_js/myapp.js'))}}

@stop