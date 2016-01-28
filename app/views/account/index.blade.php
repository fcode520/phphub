@extends('layouts.account')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/style.css')}}
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')

    <div class="my-article">
        {{--<div class="container">--}}
            <div class="row">
                <div class="col-xs-9 modify-article message-center">
                    <h2 class="title">Message center｜消息中心<button type="button" class="btn btn-success post-message" data-toggle="modal" data-target="#myMessageModel">发送站内信</button></h2>

                    <div class="clearfix"></div>
                    <p class="message-num">
                        <span>所有消息<i>10</i></span><span>评论留言<i>10</i></span><span>系统提示<i>10</i></span>
                    </p>
                    <div class="my-message">
                        @foreach ($notifications as $notification)
                        @if (count($notification->topic))
                            <ul>

                                    <li>
                                        <div class="a col-sm-1">
                                            <a href="{{ route('users.show', [$notification->from_user_id]) }}">
                                                <img class="media-object img-thumbnail avatar" alt="{{{ $notification->fromUser->username }}}" src="{{ $notification->fromUser->present()->gravatar }}"  style="width:38px;height:38px;"/>
                                            </a>
                                        </div>
                                        <div class="b col-sm-8">
                                            <a href="{{ route('users.show', [$notification->from_user_id]) }}">
                                                {{{ $notification->fromUser->name }}}
                                                {{$notification->topic->title}}
                                            </a>
                                        {{--<a href="#">你好，我们团队接到外包，缺少ios，请问你有兴趣吗？</a>--}}
                                            <p>{{ $notification->body }}</p>
                                        </div>
                                        <div class="c col-sm-3">
                                            <p class="timeago">{{ $notification->created_at }}</p>
                                            <p>未回复</p>
                                            <a href="{{ route('topics.show', [$notification->topic->id]) }}{{{ !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' }}}" title="回复" class="d">
                                                {{{ str_limit('回复', '100') }}}
                                            </a>
                                            <a href="{{ route('topics.show', [$notification->topic->id]) }}{{{ !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' }}}" title="回复" class="d">
                                                {{{ str_limit('删除', '100') }}}
                                            </a>
                                        </div>
                                    </li>

                            </ul>
                        @else

                        @endif
                        @endforeach

                            {{--<li>--}}
                                {{--<div class="a col-sm-1"><img src="images/personal_photo.png"></div>--}}
                                {{--<div class="b col-sm-8">--}}
                                    {{--<a href="#">你好，我们团队接到外包，缺少ios，请问你有兴趣吗？</a>--}}
                                    {{--<p>你好,我是montste,我们成立一个外包团队，现在缺少ios ，并且我们现在已经接到一个app外包，希望你能加入到我们团队如果你有兴趣，请回复我们，谢谢。</p>--}}
                                {{--</div>--}}
                                {{--<div class="c col-sm-3">--}}
                                    {{--<p>2分钟前&nbsp;&nbsp;&nbsp;&nbsp;未回复</p>--}}
                                    {{--<button class="d">回复</button><button>删除</button>--}}
                                {{--</div>--}}
                                {{--<div class="my-comment col-sm-11 col-sm-offset-1">--}}
                                    {{--<textarea></textarea>--}}
                                    {{--<button class="btn btn-success">回复</button>--}}
                                {{--</div>--}}
                            {{--</li>--}}

                    </div>
                </div>
            </div>
        {{--</div>--}}
    </div>
    <!--个人end-->

@stop

@section('scripts')
{{HTML::script('assets/onework_js/myapp.js')}}
@stop