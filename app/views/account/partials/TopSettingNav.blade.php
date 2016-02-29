<div class="clearfix"></div>
<ul class="personal-nav">
    <li class="{{ (Request::is('account')? 'act' : '1') }} "><a class="break" href="{{route('account')}}">个人资料</a></li>
    <li class="{{ (Request::is('account/editsetting')? 'act' : '1') }} "><a class="break" href="{{route('editsetting')}}">完善资料</a></li>
    <li class="{{ (Request::is('account/changepassword')? 'act' : '1') }} "><a class="break" href="{{route('changepassword')}}">修改密码</a></li>
</ul>