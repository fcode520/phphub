@extends('layouts.default')

@section('title')
{{ lang('Create New Topic') }}_@parent
@stop

@section('content')
<div class="container">
		<div class="row">
<div class="col-sm-9 exchange">
				<div class="new-topic">
				@if(Request::is('topics/*/edit'))
				<h2>编辑话题</h2>
				@else
				<h2>发布新话题</h2>
				@endif

					<div class="clearfix"></div>
					<div class="topic-con">
					     @if (isset($topic))
                            {{ Form::model($topic, ['route' => ['topics.update', $topic->id], 'id' => 'topic-create-form', 'method' => 'patch']) }}
                          @else
                            {{ Form::open(['route' => 'topics.store','id' => 'topic-create-form', 'method' => 'post']) }}
                          @endif
                        <div class="form-group topic-title">
                                  {{ Form::text('title', null, ['class' => 'topic-title', 'id' => 'topic-title', 'placeholder' => lang('Please write down a topic')]) }}
                        </div>
                         @include('topics.partials.composing_help_block')

                                <div class="form-group ">
                                  {{ Form::textarea('body', null, ['class' => 'form-control',
                                                                    'rows' => 20,
                                                                    'style' => "overflow:hidden",
                                                                    'id' => 'reply_content',
                                                                    'placeholder' => lang('Please using markdown.')]) }}
                                </div>

                    						        <div class="form-group">
                                                        <select class="some-select btn-group form-control" name="node_id" >

                                                          <option value="" disabled {{ App::make('Topic')->present()->haveDefaultNode($node, null) ?: 'selected'; }}>{{ lang('Pick a node') }}</option>

                                                          @foreach ($nodes['top'] as $top_node)
                                                            <optgroup label="{{{ $top_node->name }}}">
                                                              @foreach ($nodes['second'][$top_node->id] as $snode)
                                                                <option value="{{ $snode->id }}" {{ App::make('Topic')->present()->haveDefaultNode($node, $snode) ? 'selected' : ''; }} >{{ $snode->name }}</option>
                                                              @endforeach
                                                            </optgroup>
                                                          @endforeach
                                                        </select>
                                                    </div>
                    						<div class="post-art clearfix">
                                            {{ Form::submit(lang('Publish'), ['class' => 'btn btn-primary', 'id' => 'topic-create-submit']) }}
                                            </div>
                                            <div class="post-art clearfix">
                                <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>
                                </div>
                          {{Form::close()}}
					</div>
				</div>
			</div>
<!--交流页面主要内容end-->
@include('layouts.partials.sidebar')
</div>
</div>
@stop
