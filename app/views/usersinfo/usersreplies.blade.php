@if (count($replies))

                    <ul >
@foreach ($replies as $index => $reply)
                     <li>
                                   <div class="hot-news">
                                     <h2 class="hot-news-title">
                                     <a href="{{ route('topics.show', [$reply->topic_id]) }}" title="{{{ $reply->topic->title }}}">
                                             {{{ str_limit($reply->topic->title, '100') }}}
                                     </a>
                                        <span class="meta">
                                                   at <span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at }}</span>
                                     </span>
                                     </h2>

                                     <div class="hot-news-info new-hot-news-info">
                                               <div class="reply-body markdown-reply content-body">
                                         {{ $reply->body }}
                                               </div>
                                      </div>

                                   </div>
                     </li>
@endforeach
                    </ul>
{{--<div class="pull-right add-padding-vertically">--}}
{{--{{ $topics->links(); }}--}}
{{--</div>--}}
@else
    <ul >
    <div class="empty-block">{{ lang('Dont have any data Yet') }}~~</div>
    </ul>
@endif
