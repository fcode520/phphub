			<div class="col-sm-3 my-set-center">
				<ul>
				    {{--<li class="act"><a href="{{route('account')}}">个人资料</a></li>--}}


				    @if(Request::is('account')==true or Request::is('account/editsetting')==true or Request::is('account/changepassword')==true )
                    <li class=" {{'act'}}">
				    @else
				    <li class=" {{'1'}}">
				    @endif


				    <a href="{{route('account')}}">个人资料</a></li>
					<li class="{{ (Request::is('account/topics')? 'act' : '1') }}"><a href="{{route('ac_topices')}}">文章</a></li>
                    <li class="{{ (Request::is('account/notify*')? 'act' : '1') }}"><a href="{{route('ac_notify')}}">消息</a></li>
                    <li class="{{ (Request::is('account/changeheader*')? 'act' : '1') }}"><a href="{{route('changeheader')}}">修改头像</a></li>
					{{--<li><a href="#">发送站内信</a></li>--}}
				</ul>
				<span></span>
			</div>