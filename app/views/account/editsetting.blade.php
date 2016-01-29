@extends('layouts.account_right')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/style.css')}}
    {{HTML::style('assets/onework_css/layout.css')}}
    {{HTML::style('assets/onework_css/renzheng.css')}}
@stop

@section('content')
    <div class="my-article">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 modify-article message-center">
                    <h2 class="title">Message center｜个人设置</h2>

                    @include('account.partials.TopSettingNav')


                    <div class="clearfix"></div>

                    <div class="personal-infomation">
                          <div class="renzheng">

                          @include('register.resume')
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--个人end-->
@stop

@section('scripts')
{{HTML::script('assets/onework_js/myapp.js')}}
@stop