<div class="footer">
	<div class="container">
		<ul class="about clearfix">
			<li><a href="#">首页</a></li>
			<li><a href="#">关于onework</a></li>
			<li><a href="#">招贤纳士</a></li>
			<li><a href="#">服务条款</a></li>
			<li><a href="#">隐私策略</a></li>
			<li><a href="#">帮助中心</a></li>
		</ul>
		<p class="subtitle"><span>友情链接:</span></p>
		<ul class="friendlyLink clearfix">
			@if (isset($links) && count($links))
						@foreach ($links as $link)
					<li><a href="{{ $link->link }}" target="_blank" rel="nofollow" title="{{ $link->title }}">
									<img src="{{ cdn($link->cover) }}"></a></li>
						@endforeach
			@endif
		</ul>
	</div>
</div>
<!-- 版权信息 -->
<div class="copy">
	<div class="container">
		<p>Copyright &copy; 2015 - 京ICP备14019620号-2, All Rights Reserved One Work 版权所有 Support by OneWork</p>
	</div>
</div>