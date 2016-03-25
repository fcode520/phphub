@extends('layouts.default')

@section('title')
{{{ $topic->title }}}_@parent
@stop

@section('description')
{{{ $topic->excerpt }}}
@stop

@section('css')
 <link rel="stylesheet" href="{{cdn('assets/onework_css/layout.css')}}">
@stop
@section('content')


<div class="container">
<div class="row">

    <div class="col-sm-9 exchange">
           <div class="news">
               <div class="news-title">

                   <h2>{{{ $topic->title }}}</h2>
                        <div class="news-title-info">
                            <a href="{{ route('users.show', $topic->user->id) }}">
                                <img src="{{ $topic->user->present()->gravatar }}"
                                     {{--style="width:65px; height:65px;"--}}
                                     class="img-thumbnail avatar" />
                            </a>
                            <p><span><a href="{{ route('users.show', $topic->user->id) }}">{{{ $topic->user->username }}}</a></span>
                               发表于&nbsp;<abbr title="{{ $topic->created_at }}" class="timeago">{{ $topic->created_at }}</abbr></p>
                        </div>
               </div>
               <div class="news-con">
               @include('topics.partials.body', array('body' => $topic->body))

               @include('topics.partials.ribbon')
                </div>
				<div class="enjoy">
						<div class="two-icon">
							<a  data-method="post" id="topic-favorite-cancel-button" href="javascript:void(0);" data-url="{{ route('favorites.createOrDelete', $topic->id) }}">
                            <span class="glyphicon glyphicon-star" ></span>
                            </a>
                            <i>{{$topic->favorite_count}}</i>

                            <a data-method="post" href="javascript:void(0);" data-url="{{ route('topics.upvote', $topic->id) }}">
                                        <span class="glyphicon glyphicon-thumbs-up"></span>

                                    </a><i> {{ $topic->vote_count }}</i>
						</div>
						@include('topics.partials.topic_new_operate')

				</div>
    @foreach ($topic->appends as $index => $append)

        <div class="appends">
            <span class="meta">{{ lang('Append') }} {{ $index }} &nbsp;·&nbsp; <abbr title="{{ $append->created_at }}" class="timeago">{{ $append->created_at }}</abbr></span>
            <div class="sep5"></div>
            <div class="markdown-reply append-content">
                {{ $append->content }}
            </div>
        </div>

    @endforeach
           </div>
            <div class="news-comments">
            <h2>文章评论({{$topic->reply_count}})</h2>
<!-- Reply Box -->
            <div class="reply-box form box-block">

    @include('layouts.partials.errors')

    {{ Form::open(['route' => 'replies.store', 'id' => 'reply-form', 'method' => 'post']) }}
      <input type="hidden" name="topic_id" value="{{ $topic->id }}" />

        @include('topics.partials.composing_help_block')

        <div class="form-group">
            @if ($currentUser)
              {{ Form::textarea('body', null, ['class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => lang('Please using markdown.'),
                                                'style' => "overflow:hidden",
                                                'id' => 'reply_content']) }}
            @else
              {{ Form::textarea('body', null, ['class' => 'form-control', 'disabled' => 'disabled', 'rows' => 5, 'placeholder' => lang('User Login Required for commenting.')]) }}
            @endif
        </div>

        <div class="form-group status-post-submit">
            @if ($currentUser)
            <button class="btn" id="reply-create-submit">提交评论</button>
            @else
            <button class="btn disabled" id="reply-create-submit">提交评论</button>
            @endif

        </div>
        {{--<div class="form-group  box preview markdown-reply" id="preview-box" style="display:none;">--}}

        {{--</div>--}}

    {{ Form::close() }}
    <!-- Reply List -->
      <div class=" form-group  replies panel panel-default list-panel replies-index" style="box-shadow:none;">
        <div class="comment-content">

          @if (count($replies))
            @include('topics.partials.replies')
          @else
             <div class="empty-block">{{ lang('No comments') }}~~</div>
          @endif

          <!-- Pager -->
          <div class="pull-right" style="padding-right:20px">
            {{ $replies->appends(Request::except('page'))->links('layouts.partials.pagination'); }}
          </div>
        </div>
      </div>
  </div>
            </div>
    </div>

    @include('layouts.partials.sidebar')

</div>
</div>
@stop

