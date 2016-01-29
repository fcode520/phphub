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
        <div class="container">

            @include('flash::message')
            <div class="row">

                <div class="col-xs-9 modify-article">
                    <h2 class="title">Article center｜文章中心</h2>
                    <div class="clearfix">
                    </div>
                    <div class="news-list">

                        <ul>
                            @foreach($topics as $topic)
                                <li>
                                    <a href="{{ route('topics.show', [$topic->id]) }}">{{$topic->title}}</a>
                                    <p>{{$topic->view_count}} 次浏览 • <span>{{$topic->votes()->ByWhom(Auth::id())->WithType('upvote')->count()}}攒</span> • <span>{{$topic->favorite_count}}关注</span> • {{$topic->reply_count}} 个评论 • <abbr title="{{ $topic->created_at }}" class="timeago">{{ $topic->created_at }}</abbr>
                                        <a data-method="delete" id="topic-delete-button" href="javascript:void(0);" data-url="{{ route('ac.topics.destroy', [$topic->id]) }}" title="{{ lang('Delete') }}" class="">
                                           删除
                                        </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--个人 文章 end-->
@stop

@section('scripts')
{{HTML::script('assets/onework_js/myapp.js')}}
<script>
    $('#flash-overlay-modal').modal();
</script>
@stop