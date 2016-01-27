$(function(){//操作文本域的，评论
	var t = $('.comments-text');
	t.focus(function(){
		if(t.val() == "你怎么看？")
		t.val('');
	}).blur(function(){
		if(t.val() == "") {
			t.val('你怎么看？');
		};
	});
});

$(function(){//操作DOM，内页左边的菜单图标
	var t = $('.left-nav ul > li > span'),d = $('.nav-title-tip');
	t.hover(function(){		
		var i = $(this).parent().index()+1;
		d.stop().animate({opacity:"1"},400);
		d.find('i').text($(this).attr('data-text'));
		d.css('top',$(this).parent().index()*60+70);
		t.eq(i-1).css('background','url(images/'+i+i+'.png) center center no-repeat #222224');
	},function(){
		var i = $(this).parent().index()+1;
		t.eq(i-1).css('background','url(images/'+i+'.png) center center no-repeat #30333a');
		d.stop().animate({opacity:"0"},100);
	});
});

$(function(){//操作DOM 个人终极，点击回复
	var t = $('.my-message .c > .d');
	t.on('click',function(){
		var _this = $(this);
		if(_this.hasClass('act')){
			t.removeClass('act');
			t.parent().next().hide();
		}
		else{
			t.removeClass('act');
			t.parent().next().hide();
			_this.parent().next().show();
			_this.addClass('act');
		}
		
	})
});
$(function(){
	$("#distpicker").distpicker();
});
$(function(){//点击添一个项目经验

	var t = $('.project-info');
	var html = $('.one-project');
	var numProject=parseInt($('#projectNum').val());


	$('.addjingyan').on('click',function(){
		numProject+=1;
		var starttime = html.find('input[id="starttime_id"]');
		var endtime = html.find('input[id="endtime_id"]');
		var newstartid = starttime.attr('id') + '1';
		var newendid = endtime.attr('id') + '1';
		starttime.attr('id', newstartid);
		endtime.attr('id', newendid);
		t.append('<div class="one-project">'+html.html()+'</div>');
		$('.one-project').last().find('.subtitle').append('<span></span>');
		$('#projectNum').val(numProject);

	});
	$(document).on('click','span',function(e){
		$(this).parent().parent().remove();
		numProject-=1;
		$('#projectNum').val(numProject);
	});
	$.cxCalendar.defaults.startDate = 1980;
	$.cxCalendar.defaults.language = {
		monthList: ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'],
		weekList: ['日', '一', '二', '三', '四', '五', '六']
	};
	$(document).on('click',".timeclass", function(){
		$(this).cxCalendar().focus();

	});

});



// 上传图片部分
//function setImagePreview(imgId,theInput) {
//    var preview, img_txt, localImag, file_head = document.getElementById(theInput),
//    picture = file_head.value;
//    if (!picture.match(/.jpg|.gif|.png|.bmp/i))
//    return alert("您上传的图片格式不正确，请重新选择！")
//    ,$('.header > span').html('添加头像')
//    ,$('#header').attr('src','images/addheader.png')
//    ,!1;
//    if (preview = document.getElementById(imgId), file_head.files && file_head.files[0]){
//    preview.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(file_head.files[0]) : window.URL.createObjectURL(file_head.files[0]);
//    $('.header > span').html('点击头像进行替换');
//    return !0;
//    }
//
//    };

$(function() {
    $(document).ready(function () {
        var options = {
            beforeSubmit: showRequest,
            success: showResponse,
            dataType: 'json'
        };
        $('#uploadImg').on('change', function () {
            $('#upload-avatar').html('正在上传...');
            $('#uploadimgform').ajaxForm(options).submit();
        });
    });
    function showRequest() {
        $("#validation-errors").hide().empty();
        $("#output").css('display', 'none');
        return true;
    }

    function showResponse(response) {
        if (response.success == false) {
            var responseErrors = response.errors;
            $.each(responseErrors, function (index, value) {
                if (value.length != 0) {
                    $("#validation-errors").append('<div class="alert alert-error"><strong>' + value + '</strong><div>');
                }
            });
            $("#validation-errors").show();
        } else {
            $('#user-avatar').attr('src', response.avatar);
            $('#upload-avatar').html('更新完毕');
        }
    }

});











