<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OneWork 用户激活邮件</title>
</head>
<body>
<div style="font-size:28px;color:green;">
	<p>Hi{{$username}} 欢迎加入onework ，点击下方连接进行激活</p>
	<a href="{{url("activation?activation=".$activation)}}">{{"点击激活".$username."用户"}}</a>
</div>
</body>
</html>