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
		t.eq(i-1).css('background','url(/assets/images/account/'+i+i+'.png) center center no-repeat #222224');
	},function(){
		var i = $(this).parent().index()+1;
		t.eq(i-1).css('background','url(/assets/images/account/'+i+'.png) center center no-repeat #30333a');
		d.stop().animate({opacity:"0"},100);
	});
});

$(function () {//操作DOM，交流页面2 中间部分导航效果
    var t = $('.exchange-head > ul > li > a');
    var lf = $('.exchange-head > ul > li').first().width() / 2 - 6;
    if (!!t) {
        t.next().css('margin-left', lf);
    }
    t.on("click", function () {
        var li = $(this).parent('li');
        li.siblings().removeClass("act");
        li.addClass("act");
        li.find('span').css('margin-left', li.width() / 2 - 6);
    });

    //右边tab切换
    var tt = $('.list-info > .unit-c > ul > li');
    var line = $('.list-info > .unit-c > .line');
    var width = tt.find('span').width();
    line.width(width);
    if(line.length > 0){
        line.css('left',tt.first().find('span').position().left);
    }
    tt.on('click',function(){
        var left = $(this).find('span').position().left;
        $('.list-info > .unit-d').eq($(this).index()).addClass('act').siblings().removeClass('act');
        line.stop().animate({'left':left},150);
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

$(function () {//点击添加 删除 一个项目经验
    var t = $('.project-info');
    var html = $('.one-project');
    var numProject=parseInt($('#projectNum').val());
    $('.addjingyan').on('click', function () {
        numProject+=1;
        var starttime = html.find('input[id="starttime_id"]');
        var endtime = html.find('input[id="endtime_id"]');
        var newstartid = starttime.attr('id') + '1';
        var newendid = endtime.attr('id') + '1';
        starttime.attr('id', newstartid);
        endtime.attr('id', newendid);
        t.append('<div class="one-project">'+html.html()+'</div>');
        $('.one-project').last().find('.subtitle').append('<b></b>');
        $('#projectNum').val(numProject);
    });
    if(typeof($.cxCalendar)!="undefined"){
        $.cxCalendar.defaults.startDate = 1980;
        $.cxCalendar.defaults.language = {
            monthList: ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'],
            weekList: ['日', '一', '二', '三', '四', '五', '六']
        };
    }

    $(document).on('click',".timeclass", function(){
        $(this).cxCalendar().focus();

    });

    $('.project-info').on('click', 'b', function (e) {
        $(this).parent().parent().remove();
    });
});

$(function () {//操作文本域的，发送站内信
    var t = $('.m-message');
    t.focus(function () {
        if (t.val() == "消息内容")
            t.val('');
    }).blur(function () {
        if (t.val() == "") {
            t.val('消息内容');
        }
        ;
    });
});

$(function () {//左边菜单点击
    var t = $('.left-nav > ul > li');
    var s = $('.left-nav > ul > li span');
    s.on("click", function () {
        var data_src = $(this).attr('data-src');
        gotourl(data_src);
    });
});
$(function(){//认证用户列表相关js
    var t = $('.user-list-one > div').parent().height();
    if($(window).width()>768){
        $('.user-list-one > div').eq(1).height(t);
        $('.user-list-one > div').eq(2).height(t);
    }
    else{
        $('.user-list-one > div > div').css('position','static');
    }

});

$(function(){
   if($('.passwordfrom').length!=1)return;
    $('.passwordfrom').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            old_pwd:{
                validators: {
                    notEmpty: {
                        message: '旧密码不能为空'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '新密码不能为空'
                    },
                    stringLength: {
                        min: 6,
                        //max: 30,
                        message: '密码位数必须大于6位'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: '确认密码不能为空'
                    },
                    stringLength: {
                        min: 6,
                        //max: 30,
                        message: '密码位数必须大于6位'
                    },
                    identical: {
                        field: 'password',
                        message: '两次密码输入不一致'
                    }
                }
            }


        }
    });
});
$(function () {
    if ($('.editresume').length != 1)return;
    $('.editresume').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: '邮箱不能为空'
                    },
                    emailAddress: {
                        message: '请输入正确的邮箱地址'
                    }
                }
            },
            sex: {
                validators: {
                    notEmpty: {
                        message: '性别选择不能为空'
                    }
                }
            },
            skill:{
                validators: {
                    notEmpty: {
                        message: '主要技能不能为空'
                    }
                }
            },
            profession:{
                validators: {
                    notEmpty: {
                        message: '职业不能为空'
                    }
                }
            },
            qqnumber: {
                validators: {
                    notEmpty: {
                        message: 'QQ不能为空'
                    },
                    stringLength: {
                        min: 6,
                        max: 13,
                        message: 'QQ位数必须大于6位'
                    },
                    regexp: {
                        regexp: /^[0-9]*$/,
                        message: 'QQ必须是数字'
                    }
                }
            },
            province: {
                validators: {
                    notEmpty: {
                        message: '省选择不能为空'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: '市选择不能为空'
                    }
                }
            },
            district: {
                validators: {
                    notEmpty: {
                        message: '地区选择不能为空'
                    }
                }
            },
            summery: {
                message: '请务必填写个人简介',
                validators: {
                    notEmpty: {
                        message: '个人简介不能为空'
                    }
                }
            },
            experience: {
                validators: {
                    notEmpty: {
                        message: '技术经验不能为空'
                    }
                }
            },
            "ProjectName[ ]": {
                validators: {
                    notEmpty: {
                        message: '项目名称不能为空'
                    }
                }
            },
            "ProjectPosition[ ]": {
                validators: {
                    notEmpty: {
                        message: '担任职务不能为空'
                    }
                }
            },

            "starttime[ ]": {
                validators: {
                    notEmpty: {
                        message: '开始时间选择不能为空'
                    }
                }
            },
            "endtime[ ]": {
                validators: {
                    notEmpty: {
                        message: '结束时间选择不能为空'
                    }
                }
            },
            "ProjectUrl[ ]": {
                validators: {
                    notEmpty: {
                        message: '项目连接不能为空'
                    }
                }
            },
            "Projectexperience[ ]": {
                validators: {
                    notEmpty: {
                        message: '项目精力不能为空'
                    }
                }
            }

        }
    });
});

$(function(){
	$("#distpicker").distpicker();
});

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



function gotourl($url){
    if(self != top) {
        top.location.href = window.location.href;
    }
    var frameid = parent.document.getElementById("iframe_right");
    frameid.src = $url;

    $("#iframe_right").css('z-index',1);
}

