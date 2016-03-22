@if (count($favoritetopics))

                    <ul>
@foreach ($favoritetopics as $index => $topic)
                     <li>
                                   <div class="hot-news">
                                     <h2 class="hot-news-title">
                                     <a href="{{ route('topics.show', [$topic->id]) }}" title="{{{ $topic->title }}}">
                                             {{{ str_limit($topic->title, '100') }}}
                                     </a>
                                     </h2>
                                     <div class="hot-news-info new-hot-news-info">
                                         <span>
                                         {{--<a href="{{ route('nodes.show', [$topic->node->id]) }}" title="{{{ $topic->node->name }}}">--}}
                                         {{{ $topic->node->name }}}
                                         {{--</a>--}}
                                         </span>
                                         {{--<span> • </span>--}}
                                         &nbsp;&nbsp;&nbsp;
                                         {{ $topic->reply_count }} {{ lang('Replies') }}
                                         <span> • </span>
                                         <span class="timeago">{{ $topic->created_at }}</span>
                                      </div>
                                     <a class="del-article new-del-article" href="#" data-url="{{ route('favorites.createOrDelete', $topic->id) }}" title="删除收藏"></a>
                                     {{--<a   href="javascript:void(0);" data-url="{{ route('favorites.createOrDelete', $topic->id) }}">--}}

                                     {{--<span class="hot-comment new-hot-comment">111</span>--}}
                                   </div>
                     </li>
@endforeach
                    </ul>
{{--<div class="pull-right add-padding-vertically">--}}
{{--{{ $topics->links(); }}--}}
{{--</div>--}}
@else
    <ul>
        <div class="empty-block">{{ lang('Dont have any data Yet') }}~~</div>
    </ul>
@endif