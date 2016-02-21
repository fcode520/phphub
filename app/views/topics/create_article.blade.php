@extends('layouts.default')

@section('title')
{{ lang('Create New Topic') }}_@parent
@stop

@section('content')
<div class="container">
		<div class="row">
<div class="col-sm-9 exchange">
				<div class="new-topic">
					<h2>发布新话题</h2>
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
                    						{{--<div class="some-select btn-group">--}}
                    						    {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    						    {{--招聘信息&nbsp;&nbsp;<span class="caret"></span>--}}
                    						    {{--</button>--}}
                    						    {{--<ul class="dropdown-menu">--}}
                    						        {{--<li><a href="#">招聘信息1</a></li>--}}
                    							    {{--<li><a href="#">招聘信息2</a></li>--}}
                    							    {{--<li><a href="#">招聘信息3</a></li>--}}
                    							    {{--<li><a href="#">招聘信息4</a></li>--}}
                    						    {{--</ul>--}}
                    						{{--</div>--}}
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
                                {{--<div class="form-group status-post-submit">--}}
                                          {{--{{ Form::submit(lang('Publish'), ['class' => 'btn btn-primary', 'id' => 'topic-create-submit']) }}--}}
                                        {{--</div>--}}
                          {{Form::close()}}


						{{--<div class="some-select btn-group">--}}
						    {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
						    {{--招聘信息&nbsp;&nbsp;<span class="caret"></span>--}}
						    {{--</button>--}}

						    {{--<ul class="dropdown-menu">--}}
						        {{--<li><a href="#">招聘信息1</a></li>--}}
							    {{--<li><a href="#">招聘信息2</a></li>--}}
							    {{--<li><a href="#">招聘信息3</a></li>--}}
							    {{--<li><a href="#">招聘信息4</a></li>--}}
						    {{--</ul>--}}
						{{--</div>--}}
						{{--<div class="post-file clearfix">--}}
							{{--<button class="btn">本地上传</button><span>格式为JPG、JPEG、PNG，小于5MB</span>--}}
						{{--</div>--}}
						{{--<div class="post-art clearfix">--}}
							{{--<button class="btn">发&nbsp;布</button>--}}
						{{--</div>--}}
					</div>
				</div>
			</div>
<!--交流页面主要内容end-->
@include('layouts.partials.sidebar')
</div>
</div>
@stop
