@extends('layouts.account_right')

@section('title')
    个人中心_@parent
@stop

@section('css')
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
                        <span><a href="/account">所有消息</a><i>{{$notifications->sysNotifyCount+$notifications->repliesCount}}</i></span>
                        <span><a href="/account/replies">评论留言</a><i>{{$notifications->repliesCount}}</i></span>
                        <span><a href="/account/sysnotify">系统提示</a><i>{{$notifications->sysNotifyCount}}</i></span>
                    </p>
                    <div class="my-message">
                    <ul>
                        @foreach ($notifications as $notification)
                            @if (count($notification->topic))


                                    <li>
                                        <div class="a col-sm-1">
                                            <a href="{{ route('users.show', [$notification->from_user_id]) }}">
                                                <img class="" alt="{{{ $notification->fromUser->username }}}" src="{{ $notification->fromUser->present()->gravatar }}"  style="width:38px;height:38px;"/>
                                            </a>
                                        </div>
                                        <div class="b col-sm-8">
                                            {{"系统提示：您的文章 "}}<a href="{{ route('topics.show', [$notification->topic->id]) }}">{{$notification->topic->title}}</a>

                                            {{" 被 "}}<a href="{{route('users.show',[$notification->from_user_id])}}">{{$notification->fromUser->username}}</a>
                                            @if($notification->type=='topic_attent')
                                                {{" 关注"}}
                                                    @elseif($notification->type=='topic_favorite')
                                                {{" 收藏"}}
                                                    @elseif($notification->type=='topic_upvote')
                                                {{" 点赞"}}
                                                    @elseif($notification->type=='topic_mark_excellent')
                                                {{" 推荐"}}
                                                    @elseif($notification->type=='new_reply')
                                                {{" 回复"}}
                                                <p> {{ $notification->body }}</p>
                                            @else
                                                <a href="{{ route('users.show', [$notification->from_user_id]) }}">
                                                    {{$notification->fromUser->username}}
                                                    {{$notification->topic->title}}
                                                </a>
                                                <p> {{ $notification->body }}</p>

                                            @endif
                                        </div>
                                        <div class="c col-sm-3">
                                            <p class="timeago">{{ $notification->created_at }}</p>
                                            @if($notification->type=='new_reply')
                                            {{--<p>未回复</p>--}}
                                            <a href="{{ route('topics.show', [$notification->topic->id]) }}{{{ !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' }}}" title="回复" class="d">
                                                {{{ str_limit('回复', '100') }}}
                                            </a>
                                            <a href="{{ route('topics.show', [$notification->topic->id]) }}{{{ !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' }}}" title="回复" class="d">
                                                {{{ str_limit('删除', '100') }}}
                                            </a>
                                            @endif
                                        </div>
                                    </li>


                        @else

                        @endif
                        @endforeach
                    </ul>
                    </div>
                </div>
            </div>
        {{--</div>--}}
    </div>
    <!--个人end-->
@stop

@section('scripts')
{{HTML::script('assets/onework_js/myapp.js')}}
<script>
    $('#flash-overlay-modal').modal();
</script>
@stop