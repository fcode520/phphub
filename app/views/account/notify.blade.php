@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')
                <div class="col-xs-9 modify-article message-center">
                    <div class="clearfix"></div>
                    <p class="message-num">
                        <span><a href="/account/notify">所有消息</a><i>{{$notifications->sysNotifyCount+$notifications->repliesCount}}</i></span>
                        <span><a href="/account/notify/replies">评论留言</a><i>{{$notifications->repliesCount}}</i></span>
                        <span><a href="/account/notify/sysnotify">系统提示</a><i>{{$notifications->sysNotifyCount}}</i></span>
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

                                           <button> <a href="{{ route('topics.show', [$notification->topic->id]) }}{{{ !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' }}}" title="回复" class="d">
                                                {{{ str_limit('回复', '100') }}}

                                            </a>
                                            {{--<button>--}}
                                            {{--<a href="{{ route('notify.delete', [$notification->topic->id]) }}{{{ !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' }}}"  title="  回复  " class="d">--}}
                                                {{--{{{ str_limit('删除', '100') }}}--}}
                                            {{--</a>--}}
                                            {{--</button>--}}
                                            @endif
                                        </div>
                                    </li>


                        @else

                        @endif
                        @endforeach
                    </ul>
                    </div>
                </div>
    <!--个人end-->
@stop

@section('scripts')
<script>
    $('#flash-overlay-modal').modal();
</script>
@stop