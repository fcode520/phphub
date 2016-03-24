<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>OneWork 用户激活邮件</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body style="background: #e1e8ed;margin: 0;padding: 0;">

	<!--邮件样式-->
	<div style="width: 90%;height: auto;max-width: 800px;margin: 0 auto;overflow: hidden;background: #fff;padding:0;">
		<p style="font-size: 18px;color: #66757f;border-bottom: 1px solid #e1e8ed;padding: 40px 0 40px 100px;margin: 0;">亲爱的 {{$username}}</p>
		<div class="email clearfix" style="padding: 0 100px;border-bottom: 1px solid #e1e8ed;margin: 0;">
			<h2 style="color: #66757f;font-size: 30px;font-weight: 400;padding: 50px 0 10px;margin: 0;">请欢迎加入OneWork！</h2>
			<p style="color: #66757f;font-size: 16px;padding: 10px 0 70px;margin: 0;line-height: 1.5;">
			请尽快验证您的邮箱，以便享受更多功能与服务。</br>很简单－只需要点击下面的按钮即可</p>
			<a href="{{url("activation?activation=".$activation)}}" style="color: #fff;background: #5ecf81;width: 200px;height: 60px;display: block;text-align: center;text-decoration: none;line-height: 60px;border-radius: 5px;margin-bottom: 70px;font-size: 20px;padding: 0;">立即激活</a>
		</div>
		<div class="footer" style="text-align: center;color: #66757f;padding-bottom: 30px;margin: 0;">
			<p style="margin: 20px 0;font-size: 14px;padding: 0;">
			<a style="color: #5ecf81;margin: 0;padding: 0;" href="{{route('home')}}">onework</a>|
			<a style="color: #5ecf81;margin: 0;padding: 0;" href="{{route('about')}}">About Us</a>|
			<a style="color: #5ecf81;margin: 0;padding: 0;" href="{{route('home')}}">加入我们</a></p>
			<p style="margin: 0;padding: 0;">Copyright © 2016 - 京ICP备14019620号-2</p>
		</div>
	</div>

</body>
</html>
