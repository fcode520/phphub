<!DOCTYPE html>
<html lang="zh">
	<head>

		<meta charset="UTF-8">

		<title>
			@section('title')
OneWork & 远程工作者社区
			@show
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<meta name="keywords" content="Onework,远程办公,远程工作,在家办公,soho" />
		<meta name="author" content="The OneWork  Community." />
		<meta name="description" content="@section('description') 我们崇尚工作方式简单化，所以A Personal Computer, One Work!是我们的追求，更是我们的初心。 @show" />

        <link rel="stylesheet" href="{{ cdn('assets/css/'.Asset::styles('frontend')) }}">
        {{HTML::style('assets/onework_css/layout.css')}}
        <link rel="shortcut icon" href="{{ cdn('favicon.ico') }}"/>
        @yield('css')
        <script>
            Config = {
                'cdnDomain': '{{ getCdnDomain() }}',
                'user_id': {{ $currentUser ? $currentUser->id : 0 }},
                'routes': {
                    'notificationsCount' : '{{ route('notifications.count') }}',
                    'upload_image' : '{{ route('upload_image') }}'
                },
                'token': '{{ csrf_token() }}'
            };
        </script>

	    @yield('styles')

	</head>
	<body id="body">

		<div id="wrap">

			@include('layouts.partials.nav')
			@if(isset($currentUser))
                @if($currentUser->status==0)
                <div class="banner-text" data-time="20000">
                    <p>请激活当前用户,以便进行后续操作！</button>
                    <a class="btn btn-default btn-sm" href="{{route('SendActivationEmail')}}">点击激活</a>
                    </p>
                </div>
             @endif
            @endif
        <div class="container">

        {{--@include('flash::message')--}}
		@yield('content')
		</div>

		</div>

		@include('layouts.partials.footer')

		<script src="{{ cdn('assets/js/'.Asset::scripts('frontend')) }}"></script>
		<script src="{{ cdn('assets/js/onework.js')}}"></script>
		<script src="{{ cdn('assets/js/popDialog.js')}}"></script>
	    @yield('scripts')

	</body>
</html>
