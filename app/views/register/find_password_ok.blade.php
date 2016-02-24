@extends('layouts.default')

@section('content')
    <div class="container register_ok">
      <div class="email-ok text-center">
        <h2>找回密码</h2>
                <p>找回密码邮件已经发送</p>
                <p class="a" >{{$email}}</p>
                <p>点击邮件里的链接即可找回密码</p>
                <p class="b">还没收到确认邮件？尝试到广告邮件，垃圾邮件目录里找找看!</p>

              </div>
      </div>
    <div class="container"></div>
@stop
