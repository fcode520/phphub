@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')
                <div class="col-xs-9 modify-article">
                <div class="clearfix"></div>
              <p class="message-num">
                <span>我的文章</span>
                </p>
                    <div class="news-list">

                        <ul>
                            @foreach($topics as $topic)
                                <li>
                                <div class="TopicTiele">
                                    <a href="{{ route('topics.show', [$topic->id]) }}">{{$topic->title}}</a>
                                </div>
                                    <p>{{$topic->view_count}} 次浏览 <span>{{$topic->votes()->ByWhom(Auth::id())->WithType('upvote')->count()}}攒</span> <span>{{$topic->favorite_count}}关注</span>  {{$topic->reply_count}} 个评论   <abbr title="{{ $topic->created_at }}" class="timeago">{{ $topic->created_at }}</abbr>
                                        <a data-method="delete" id="topic-delete-button" href="javascript:void(0);" data-url="{{ route('ac.topics.destroy', [$topic->id]) }}" title="{{ lang('Delete') }}" class="">
                                           删除
                                        </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
    <!--个人 文章 end-->

@stop

@section('scripts')
{{--{{HTML::script(cdn('assets/js/'.Asset::scripts('frontend')))}}--}}
{{--{{HTML::script('assets/onework_js/myapp.js')}}--}}
<script>
    $('#flash-overlay-modal').modal();
</script>
@stop