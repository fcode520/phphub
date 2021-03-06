

@if (count($topics))

<ul class="">
    @foreach ($topics as $topic)
     <li>
                  <div class="photo">
                      <a href="{{ route('users.show', [$topic->user_id]) }}">
                   <img class="" alt="{{{ $topic->user->username }}}"
                   src="{{ $topic->user->present()->gravatar }}"
                    style="width:48px;height:48px;"/>
                      </a>
                    </div>
                   <div class="hot-news">
                     <h2 class="hot-news-title">
                     <a href="{{ route('topics.show', [$topic->id]) }}" title="{{{ $topic->title }}}">
                      {{{ $topic->title }}}</a>
                      </h2>

                     <div class="hot-news-info">
                     {{--节点--}}
                        <a class="topic_node" href="{{ route('nodes.show', [$topic->node->id]) }}" title="{{{ $topic->node->name }}}">
                        <span> {{{ $topic->node->name }}}</span>
                        </a>
                    {{--作者--}}
                         <a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->username }}">
                             {{{ $topic->user->username }}}
                         </a>
                    {{--时间--}}
                         <span> • </span>
                         <span class="timeago">{{ $topic->created_at }}</span>
                   {{--有回复--}}
                @if ($topic->reply_count > 0 && count($topic->lastReplyUser))
                    {{ "最后回复来自"}}
                    <a href="{{{ URL::route('users.show', [$topic->lastReplyUser->id]) }}}">
                      {{{ $topic->lastReplyUser->username }}}
                    </a>
                    {{--<span> • </span>--}}
                    {{--<span class="timeago">{{ $topic->updated_at }}</span>--}}
                @endif
                         </div>
                     <a class="pull-right" href="{{ route('topics.show', [$topic->id]) }}" >
                                 <span class="hot-comment"> {{ $topic->reply_count }} </span>
                      </a>
                   </div>
     </li>
     @endforeach

</ul>

@else
   <div class="empty-block">{{ lang('Dont have any data Yet') }}~~</div>
@endif
