@extends('layouts.default')

@section('title')
{{ "导航" }} @parent
@stop

@section('css')
    <link rel="stylesheet" href="{{cdn('assets/onework_css/layout.css')}}">
@stop


@section('navigation-title')
	<!--导航页面 begin-->
	<div class="navigation-title">
		<p>远程办公协作工具</p>
		<a href="#">如何发布？</a>
	</div>
@stop
@section('content')
<div class="container">
		<div class="row">
			<div class="navigation-nav clearfix">
				<ul>
					<li><a class="{{Request::is('hao')?'act':' '}}" href="#">全部</a></li>
					@foreach($categorys as $category)
					<li><a class="{{Request::is('hao/'.$category->id)?'act':' '}}" href="{{route('haoCattegory',$category->id)}}">{{$category->LinkCategoryName}}</a></li>
					@endforeach

				</ul>
			</div>

			<div class="navigation-nav">
				<div class="row">
				@foreach($items as $item)
					<div class="col-sm-6 navigation-info">
						<p>{{$item->LinkName}}</p>
						<a href="#"><img src={{$item->Logo}} width="100%"></a>
						<div>{{$item->LinkDescription}}</div>
					</div>
                @endforeach


				</div>


			</div>
		</div>
	</div>
@stop
