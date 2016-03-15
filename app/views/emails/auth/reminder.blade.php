{{--<!DOCTYPE html>--}}
{{--<html lang="en-US">--}}
	{{--<head>--}}
		{{--<meta charset="utf-8">--}}
	{{--</head>--}}
	{{--<body>--}}
		{{--<h2>Password Reset</h2>--}}

		{{--<div>--}}
			{{--To reset your password, complete this form: {{ URL::to('password/reset', array($token)) }}.<br/>--}}
			{{--This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.--}}
		{{--</div>--}}
	{{--</body>--}}
{{--</html>--}}
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>OneWork 密码找回</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body{background: #e1e8ed;}
		*{margin: 0;padding: 0;}
		.container{width: 90%;height: auto;max-width: 800px;margin: 0 auto;overflow: hidden;background: #fff;}
		.title{font-size: 18px;color: #66757f;border-bottom: 1px solid #e1e8ed;padding: 40px 0 40px 100px;}
		.email > h2{color: #66757f;font-size: 30px;font-weight: 400;padding: 50px 0 10px;}
		.email{padding: 0 100px;border-bottom: 1px solid #e1e8ed;}
		.email > p{color: #66757f;font-size: 16px;padding: 10px 0 70px;}
		.email > a{color: #fff;background: #5ecf81;width: 200px;height: 60px;display: block;text-align: center;text-decoration: none;line-height: 60px;border-radius: 5px;margin-bottom: 70px;font-size: 20px;}
		.email > a:hover{background: #4cae4c;}
		.footer{text-align: center;}
		.footer{color: #66757f;padding-bottom: 30px;}
		.footer > p{margin: 20px 0;font-size: 14px;}
		.footer > p > a{color: #5ecf81;}
		.footer > p > a:hover{color: #4cae4c;}
		@media screen and (max-width:700px){
			.container{padding: 0 20px;}
			.title{padding-left: 20px;}
			.email{padding: 0 20px;}
		}
	</style>
</head>
<body>

<!--邮件样式-->
<div class="container">
	<p class="title">Hi {{$user->username}} 你好</p>
	<div class="email clearfix">

		<h2>OneWork 密码找回请求！</h2>
         <p>我们的系统收到一个请求，说你希望通过电子邮件重新设置你在 OneWork 的密码。你可以点击下面的链接开始重设密码：</p>

		<a href="{{ URL::to('password/reset', array($token)) }}">找回密码</a>
		<p>如果这个请求不是由你发起的，那没问题，你不用担心，你可以安全地忽略这封邮件</p>
	</div>
	<div class="footer">
		<p><a href="{{route('home')}}">onework</a>|<a href="{{route('about')}}">About Us</a>|<a href="{{route('home')}}">加入我们</a></p>
		<p>Copyright © 2016 - 京ICP备14019620号-2, </p>
	</div>
</div>

</body>
</html>