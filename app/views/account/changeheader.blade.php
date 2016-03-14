@extends('layouts.default')

@section('title')
    个人中心_@parent
@stop

@section('css')
    {{HTML::style('assets/onework_css/layout.css')}}
@stop

@section('content')
@include('account.partials.leftnav')

@include('account.partials.avatar')



@stop

@section('scripts')
    <script src="{{ cdn('assets/js/cropbox.js')}}"></script>
    <script type="text/javascript">
    	    $(window).load(function() {
    	        var options =
    	        {
    	            thumbBox: '.thumbBox',
    	            spinner: '.spinner',
    	            imgSrc: $('.imageBox').attr('date')
    	        }
    	        var cropper = $('.imageBox').cropbox(options);
    	        $('#file').on('change', function(){
    	            var reader = new FileReader();
    	            reader.onload = function(e) {
    	                options.imgSrc = e.target.result;
    	                cropper = $('.imageBox').cropbox(options);
    	            }
    	            var filetype=this.files[0];
                    if(!/image\/\w+/.test(filetype.type)){
                    alert("请确保文件为图像类型");
                    return false;
                    }
    	            reader.readAsDataURL(this.files[0]);
    	            this.files = [];
    	        })
    	        $('#btnCrop').on('click', function(){
    	            var img = cropper.getDataURL();
    	            $('.cropped').html('<img src="'+img+'">');
    	        })
    	        $('#btnZoomIn').on('click', function(){
    	            cropper.zoomIn();
    	        })
    	        $('#btnZoomOut').on('click', function(){
    	            cropper.zoomOut();
    	        })
    	    });
    	</script>

@stop