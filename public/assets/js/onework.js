$(function(){//顶部头像 滑过后效果等
    var w = $('.header-info').find('ul').outerHeight();
    $('.personal-header').hover(function(){
            $('.header-info').stop().animate({'height':w},100);
        $('.tiangle').fadeIn(100);
    },function(){
        $('.header-info').stop().animate({'height':0},100);
        $('.tiangle').fadeOut(100);
    });
    var t = $('.header-info > ul > li');
    var line = $('.header-info > p');
    var top = t.parent().find('.act').index()*28+10;
    line.css('top',top);
    t.on('click',function(){
        $(this).addClass('act').siblings().removeClass('act');
    });
    t.find('a').hover(function(){
        line.stop().animate({'top':$(this).parent().index()*28+10},100);
        $('.header-info > ul > .act > a').css({'color':'#666'});
    },function(){
        line.stop().animate({'top':t.parent().find('.act').index()*28+10},100);
        $('.header-info > ul > .act > a').css({'color':'#63ce83'});
    })
});
$(function(){//顶部导航
    var i = $('.nav > i');
    var t = $('.nav > li > a');
    var act = $('.nav > .act');
    if(act.length<1)return;
    i.css('width',t.width()+10);
    i.css({'left':act.position().left+10,'width':act.find('a').width()+10});
    i.stop().animate({'left':act.position().left+10,'width':act.find('a').width()+10},300)
        t.hover(function(){
            i.stop().animate({'left':$(this).parent().position().left+10,'width':$(this).width()+10},300);
            act.find('a').css({'color':'#777'});
        },function(){
            i.stop().animate({'left':act.position().left+10,'width':act.find('a').width()+10},300)
            act.find('a').css({'color':'#63ce83'});
        });



});
$(function(){//操作DOM 个人终极，点击回复
    var t = $('.two-icon >a');
    t.on('click',function(){
        $from=$(this).find('from');
        $.ajax({
            type:"POST",
            async:true,//异步请求  默认为true,设置为false的话,suncess之后，才会继续执行  下面的js
            data:$from.serialize(),// 你的formid
            url:$from.attr('action'),
            success:function(msg){
                $('#PopDialog').successPOP();
            },
            error:function(msg){
                $('#PopDialog').errorPOP();
            }

        });
    })
});
$(function(){//横幅提示信息
    var time = $('.banner-text').attr('data-time');
    if(!!time && time < 100000){
        $('.banner-text').stop().animate({'height':50},300);
        setTimeout(function(){
            $('.banner-text').stop().animate({'height':0},300);
        },time)
    }
    if(time == 100000 || time > 100000){
        $('.banner-text').css('background','#ff5350');
        $('.banner-text').stop().animate({'height':50},300);
        $('.banner-text > p > span').css('cursor','pointer').on('click',function(){
            $('.banner-text').stop().animate({'height':0},300);
        });
    }
});

//send_valid_mail
$('.send_valid_mail').on('click',function(){
    var id=$(this).attr('data');
    var CSRF_TOKEN = Config['token'];
    var posturl='/vaild_email/'+id ;
    $.ajax({
        url: posturl,
        type: 'POST',
        data: {_token: CSRF_TOKEN,id:id},
        dataType: 'html',
        success:function(msg){
            if(msg=="true"){
                $('#PopDialog').successPOP({text:'操作成功'});
            }else{
                $('#PopDialog').errorPOP({text:'提交失败'});
            }

        },
        error:function(msg){
            $('#PopDialog').errorPOP({text:'提交异常'});
        }

    });
})


function delete_notify(nid){
    var CSRF_TOKEN = Config['token'];
    var posturl='/account/notify/delete/'+nid ;
    $.ajax({
        url: posturl,
        type: 'POST',
        data: {_token: CSRF_TOKEN,_nid:nid},
        dataType: 'html',
        success: function (data) {
            if(data=="true"){
                alert("You pressed OK!");
                console.log(data);
                $('#PopDialog').successPOP();
            }else{
                alert("You pressed Not OK!");
                console.log(data);
            }

        }

    });
}

$(function(){
    $('.deletenotify').on('click',function(){

        var nid=$(this).attr('id');
        var CSRF_TOKEN = Config['token'];
        var posturl='/account/notify/delete/'+nid ;
        var li=$(this).parent().parent().parent();
        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,_nid:nid},
            dataType: 'html',
            success: function (data) {
                if(data=="true"){
                    //alert("You pressed OK!");
                    li.remove();
                    $('#PopDialog').successPOP();
                }else{
                    $('#PopDialog').errorPOP();
                }

            }

        });


    })
});
//
//$(function() {
//    try{
//        var options =
//        {
//            thumbBox: '.thumbBox',
//            spinner: '.spinner',
//            imgSrc: $('.imageBox').attr('date')
//        }
//
//        var cropper = $('.imageBox').cropbox(options);
//
//        $('#file').on('change', function () {
//            var reader = new FileReader();
//            reader.onload = function (e) {
//                options.imgSrc = e.target.result;
//                cropper = $('.imageBox').cropbox(options);
//            }
//            var filetype=this.files[0];
//            if(!/image\/\w+/.test(filetype.type)){
//                alert("请确保文件为图像类型");
//                return false;
//            }
//            reader.readAsDataURL(this.files[0]);
//            this.files = [];
//        })
//        $('#btnCrop').on('click', function () {
//            var img = cropper.getDataURL();
//            if(img=='noimg'){
//                alert('请上传正确格式的图片');
//                return ;
//            }
//            $('.cropped').html('<img src="' + img + '">');
//        })
//        $('#btnZoomIn').on('click', function () {
//            cropper.zoomIn();
//        })
//        $('#btnZoomOut').on('click', function () {
//            cropper.zoomOut();
//        })
//    }catch(err){
//
//    }
//
//
//});
$(function(){
    $('.save-avatar').on('click',function(){


        var img=$('.cropped >img');
        var imgdata='';
        if(img.length<=1) {
            $('#btnCrop').click();
            img=$('.cropped >img');
        }
        imgdata=img.attr('src');
        var CSRF_TOKEN = Config['token'];
        var posturl='/account/changeheader' ;
        $('#updateheader').show();
        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,imgdata:imgdata},
            dataType: 'html',
            success: function (data) {
                if(data=="false"){
                    //alert("You pressed faild!");
                    $('#updateheader').hide();
                    swal("抱歉!", "头像上传成功", "error");
                }else{
                    //alert("You pressed ok!");
                    $('#updateheader').hide();
                    swal("Good!", "头像上传成功", "success");
                    //window.location.reload(true)
                    //$('#PopDialog').errorPOP();
                    var name=$('.personal-header >a').text();
                    $('.personal-header >a').html('<img alt="'+name+'"src="' + imgdata + '" style="width:30px;height:30px;">'+name);
                }

            }

        });


    })
});
//新－个人主页
$(function(){
    var t = $('.new-personal-head > ul > li');
    var width = t.find('.act').width();
    var line = $('.new-line');
    if(!!t && line.length > 0){
        line.css({'width':width}).css({'left':t.parent().find('.act').position().left+15});
        t.on('click',function(){
            $(this).addClass('act').siblings().removeClass('act');
            $('.new-hot-con > ul').eq($(this).index()).addClass('act').siblings().removeClass('act');
        });
        t.hover(function(){
            line.stop().animate({'left':$(this).position().left+15},300);
            $('.header-info > ul > .act > a').css({'color':'#666'});
        },function(){
            line.stop().animate({'left':t.parent().find('.act').position().left+15},300);
            $('.header-info > ul > .act > a').css({'color':'#63ce83'});
        })
    }
    // var ops = {//可以作为tooltip的参数，具体可以看其api介绍
    //     title:"123213",
    //     trigger:"hover"
    // }
    $('.new-personal-name span[data-toggle="tooltip"]').tooltip();
});
$(function(){

    $('#Focus').on('click',function(){
        var ToUserID=$(this).attr('data');
        var CSRF_TOKEN = Config['token'];
        var posturl='/users/focus' ;
        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,_ntoid:ToUserID},
            dataType: 'html',
            success:function(msg){
                $('#PopDialog').successPOP({text:'操作成功'});
                $('#Focus')[0].text=msg
            },
            error:function(msg){
                $('#PopDialog').errorPOP({text:'提交失败'});
            }

        });
    })
    $('.rfocusEachother').on('click',function(){
        //alert("yes-focus");
        var ToUserID=$(this).attr('data');
        var CSRF_TOKEN = Config['token'];
        var posturl='/users/focus' ;
        var _this = $(this);
        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,_ntoid:ToUserID},
            dataType: 'html',
            success:function(msg){

                $('#PopDialog').successPOP({text:'操作成功'});
                if(msg=='关注'){
                    _this.unbind('mouseenter').unbind('mouseleave');
                    _this.attr('class','rFocus');
                    _this.find('i').text('关注');
                    _this.find('span').attr('class','glyphicon glyphicon-plus');
                }
                else{
                    _this.on('hover');
                    _this.attr('class','yes-focus');
                    _this.find('i').text('相互关注');
                    _this.find('span').attr('class','glyphicon glyphicon-sort');
                    _this.hover(function(){
                        _this.text = '相互关注';
                        _this.clas = _this.find('span').attr('class');
                        _this.find('i').text('取消关注');
                        _this.addClass('no-focus');
                        _this.find('span').attr('class','glyphicon glyphicon-minus');
                    },function(){
                        if(!_this.attr('class'))return;
                        _this.find('i').text(_this.text);
                        _this.removeClass('no-focus');
                        _this.find('span').attr('class',_this.clas);
                    });
                }

            },
            error:function(msg){
                $('#PopDialog').errorPOP({text:'提交失败'});
            }

        });
    })
    $('.rFocus').on('click',function(){
        //alert("rFocus");
        $(this).unbind('mouseenter').unbind('mouseleave');
        var ToUserID=$(this).attr('data');
        var CSRF_TOKEN = Config['token'];
        var posturl='/users/focus' ;
        var ToUserID=$(this).attr('data');
        var CSRF_TOKEN = Config['token'];
        var posturl='/users/focus' ;
        var _this = $(this);
        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,_ntoid:ToUserID},
            dataType: 'html',
            success:function(msg){

                $('#PopDialog').successPOP({text:'操作成功'});
                if(msg=='关注'){
                    _this.unbind('mouseenter').unbind('mouseleave');
                    _this.attr('class','');
                    _this.find('i').text('关注');
                    _this.find('span').attr('class','glyphicon glyphicon-plus');
                }
                else{
                    _this.on('hover');
                    _this.attr('class','yes-focus');
                    _this.find('i').text('相互关注');
                    _this.find('span').attr('class','glyphicon glyphicon-sort');
                    _this.hover(function(){
                        _this.text = '相互关注';
                        _this.clas = _this.find('span').attr('class');
                        _this.find('i').text('取消关注');
                        _this.addClass('no-focus');
                        _this.find('span').attr('class','glyphicon glyphicon-minus');
                    },function(){
                        if(!_this.attr('class'))return;
                        _this.find('i').text(_this.text);
                        _this.removeClass('no-focus');
                        _this.find('span').attr('class',_this.clas);
                    });
                }

            },
            error:function(msg){
                $('#PopDialog').errorPOP({text:'提交失败'});
            }

        });
    })
    $('.rEachother').on('click',function(){
        //alert("rEachothers");
        var ToUserID=$(this).attr('data');
        var CSRF_TOKEN = Config['token'];
        var posturl='/users/focus' ;
        var _this = $(this);
        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,_ntoid:ToUserID},
            dataType: 'html',
            success:function(msg){

                $('#PopDialog').successPOP({text:'操作成功'});
                if(msg=='关注'){
                    _this.parent().remove();
                }
            },
            error:function(msg){
                $('#PopDialog').errorPOP({text:'提交失败'});
            }

        });
    })

    $('#mysubmit').click(function() {
        $.ajax({
            type:"POST",
            async:false,//异步请求  默认为true,设置为false的话,suncess之后，才会继续执行  下面的js
            data:$('#changepwd').serialize(),// 你的formid
            url:"/account/changepassword",
            success:function(msg){
                if(msg[0]=='error'){
                    $('#PopDialog').errorPOP({text:msg[1]});
                    return;
                }
                $('#PopDialog').successPOP({text:msg[1]});
            },
            error:function(msg){
                $('#PopDialog').errorPOP({text:'密码修改异常，请重新提交！'});
            }

        });
    });
});
$(function(){//关注粉丝列表
    var t = $('.yes-focus');
    var _this = this;
    if(t.length < 1)return;
    t.hover(function(){
        _this.text = $(this).text();
        _this.clas = $(this).find('span').attr('class');
        $(this).find('i').text('取消关注');
        $(this).addClass('no-focus');
        $(this).find('span').attr('class','glyphicon glyphicon-minus');
    },function(){
        if(!$(this).attr('class'))return;
        $(this).find('i').text(_this.text);
        $(this).removeClass('no-focus');
        $(this).find('span').attr('class',_this.clas);
    });

});
$(function () {//点击添加 删除 一个项目经验
    function showtime(){
        var mydate = new Date();
        var year=mydate.getFullYear();
        var Month=mydate.getMonth()+1
        var day=mydate.getDate();


        var str = "" + year + "-";
        str += (Month)<10?"0"+Month:Month;
        str+="-";
        str += day<10?"0"+day:day ;
        return str;
    }
    var t = $('.project-info');
    if(t.length<1 ) return;
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
        $('.one-project').last().find('input').val('');
        $('.one-project').last().find('textarea').val('');
        $('.one-project').last().find('.timeclass').attr('placeholder',showtime);
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

$(function () {
$('.praise_product').click(function() {
    var pid=$(this).attr('data');
    var CSRF_TOKEN = Config['token'];
    var voteCount=$('.praise_product .voteCount').text();
    voteCount++;
    $.ajax({
        type:"POST",
        async:false,//异步请求  默认为true,设置为false的话,suncess之后，才会继续执行  下面的js
        data: {_token: CSRF_TOKEN,_pid:pid},
        url:"/users/praise_count",
        success:function(msg){
            if(msg[0]){
                $('#PopDialog').successPOP({text:msg[1]});
                $('.praise_product .voteCount').text(voteCount);
            }else{
                $('#PopDialog').errorPOP({text:msg[1]});
            }
        },
        error:function(msg){
            $('#PopDialog').errorPOP({text:msg});
        }

    });
});
});
//$(function(){
//    var dh = $(document).height();//整个网页高度
//    var wh = $(window).height();//浏览器窗口高度
//    var warp=$("#wrap").height();
//    var t = $('.footer');
//    var copy=$('.copy');
//    if(t.length > 0 && warp>0 && dh > warp){
//
//        copy.css({'position':'static','bottom':0,'left':0});
//        t.css({'position':'static','bottom':40,'left':0});
//    }
//});
$(function () {

    var footerHeight = 0,
        footerTop = 0,
        $footer = $("#myFooter");

    positionFooter();

    function positionFooter() {

        //footerHeight = $footer.height();
        footerHeight = 231;
        footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";

        if ( ($(document.body).height()+footerHeight) < $(window).height()) {
            $footer.css({
                position: "absolute"
            });
        } else {
            $footer.css({
                position: "static"
            });
        }

    }

    $(window)
        .scroll(positionFooter)
        .resize(positionFooter)
});


$(function(){
    //新主页 图片切换
    if($('.new-index-pic-box > ul').length < 1)return;
    var ul = $('.new-index-pic-box > ul'),
        li = $('.new-index-pic-box > ul > li'),
        tabbox = $('.new-index-pic-tab')
    left = $('.pic-tab-left'),
        right = $('.pic-tab-right'),
        box = $('.new-index-pic-box')
    w = (li.innerWidth()+20);
    left.click(function(){
        ul.find('li:last').prependTo(ul);
        ul.css({'margin-left':-w});
        ul.animate({'margin-left':0});
    });
    right.click(function(){
        ul.animate({'margin-left':-w},function(){
            ul.find('li').eq(0).appendTo(ul);
            ul.css({'margin-left':0});
        });
    });
    var tab = function(){
        ul.stop().animate({marginLeft:-w},500,function(){
            ul.find('li').eq(0).appendTo(ul);
            ul.css({'margin-left':0});
        });
    };
    var timer = setInterval(tab , 3000);

    tabbox.hover(function(){
        clearInterval(timer);
    },function(){
        timer = setInterval(tab , 3000);
    })

});