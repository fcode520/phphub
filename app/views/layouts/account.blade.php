<!--
______                            _              _                                     _
| ___ \                          | |            | |                                   | |
| |_/ /___ __      __ ___  _ __  | |__   _   _  | |      __ _  _ __  __ _ __   __ ___ | |
|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | | | |     / _` || '__|/ _` |\ \ / // _ \| |
| |  | (_) |\ V  V /|  __/| |    | |_) || |_| | | |____| (_| || |  | (_| | \ V /|  __/| |
\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \_____/ \__,_||_|   \__,_|  \_/  \___||_|
                                          __/ |
                                         |___/
  ========================================================
                                           phphub.org

  --------------------------------------------------------
  Laravel: v4.2.8
-->

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
				'token': '{{ csrf_token() }}',
			};
		</script>
	    @yield('styles')

	</head>
	<body id="body">

		<div id="wrap">

			@include('account.partials.leftnav')


				@include('flash::message')

				@yield('content')


		</div>
		@include('account.partials.footer')


        <script src="{{ cdn('assets/js/'.Asset::scripts('frontend')) }}"></script>

	    @yield('scripts')


	</body>
</html>
