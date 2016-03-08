{{--<!doctype html>--}}
{{--<html>--}}
{{--<head>--}}
	{{--<meta charset="utf-8">--}}
	{{--<meta name="description" content="">--}}
	{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
	{{--<title>OneWork 用户激活邮件</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div style="font-size:28px;color:green;">--}}
	{{--<p>Hi{{$username}} 欢迎加入onework ，点击下方连接进行激活</p>--}}
	{{--<a href="{{url("activation?activation=".$user->activation)}}">{{"点击激活".$username."用户"}}</a>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
{{--<!DOCTYPE html>--}}
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>OneWork 用户激活邮件</title>
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
	<p class="title">{{$username}}</p>
	<div class="email clearfix">
		<h2>最后一步......</h2>
		<p>请确认你的电子邮件地址以完成你的{{$username}}账号{{$email}}注册。很简单－只需要点击下面的按钮即可</p>
		<a href="{{url("activation?activation=".$activation)}}">立即确认</a>
	</div>
	<div class="footer">
		<p><a href="#">帮助</a>|<a href="#">帮助</a>|<a href="#">帮助</a></p>
		<p>Copyright © 2016 - 京ICP备14019620号-2, </p>
	</div>
</div>

</body>
</html>