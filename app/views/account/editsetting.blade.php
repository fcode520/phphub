@extends('layouts.account_right')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
    <div class="my-article">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 modify-article message-center">
                    <h2 class="title">Message center｜个人设置</h2>

                    @include('account.partials.TopSettingNav')


                    <div class="clearfix"></div>

                    <div class="renzheng  attestation">
                          @include('register.resume')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--个人end-->
@stop

@section('scripts')
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.min.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.cxcalendar.languages.js'))}}
    {{HTML::script(cdn('assets/onework_js/jquery.form.js'))}}
    {{HTML::script(cdn('assets/onework_js/myapp.js'))}}
@stop