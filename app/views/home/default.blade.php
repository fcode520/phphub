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
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?5dbe49a97b6730632b93ed44db92ba06";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>

	</head>
	<body id="body">

        @yield('content')




		<script src="{{ cdn('assets/js/'.Asset::scripts('frontend')) }}"></script>
		<script src="{{ cdn('assets/js/onework.js')}}"></script>
		<script src="{{ cdn('assets/js/popDialog.js')}}"></script>
	    @yield('scripts')


	</body>
</html>
