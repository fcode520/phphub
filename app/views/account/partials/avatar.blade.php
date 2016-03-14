{{--<div class="clearfix"></div>--}}


    {{--@if (Auth::check())--}}
    {{--<div class="imageBox" date="{{ $currentUser->present()->gravatar }}">--}}
    {{--@else--}}
    {{--<div class="imageBox">--}}
    {{--@endif--}}

        {{--<div class="thumbBox"></div>--}}
        {{--<div class="spinner" style="display: none">Loading...</div>--}}
    {{--</div>--}}

    {{--<div class="action">--}}
        {{--<input type="file" id="file" style="float:left; width: 250px">--}}
        {{--<input type="button" id="btnCrop" value="Crop" style="float: right">--}}
        {{--<input type="button" id="btnZoomIn" value="+" style="float: right">--}}
        {{--<input type="button" id="btnZoomOut" value="-" style="float: right">--}}
        {{--<input type="button" class="submitavatar" id="submitavatar" value="提交图片" style="float: left width: 250px">--}}
    {{--</div>--}}
    {{--<div class="cropped">--}}

{{--</div>--}}
<div class="col-sm-9 change-avatar">
				<div class="change-avatar-left">
					<p>头像设置</p>
					    @if (Auth::check())
                        <div class="imageBox" date="{{ $currentUser->present()->gravatar }}">
                        @else
                        <div class="imageBox">
                        @endif
					    <div class="thumbBox"></div>
					    <div class="spinner" style="display: none">Loading...</div>
					</div>
					<div class="action">
					    <a href="javascript:;" class="file">选择文件
					    	<input type="file" id="file">
					    </a>
					    <input type="button" id="btnCrop" value="剪切预览">
					    <input type="button" id="btnZoomIn" value="+" style="float: right">
					    <input type="button" id="btnZoomOut" value="-" style="float: right">
					</div>
					<p>支持jpg、jpeg、gif、png、bmp格式的图片</p>
					<input type="button" value="保存头像"  class="save-avatar btn btn-success"></input>
				</div>

				<div class="change-avatar-right">
					<div class="cropped">
                        <img src="{{ $currentUser->present()->gravatar }}">
					</div>
					<p>预览</p>
				</div>

			</div>


