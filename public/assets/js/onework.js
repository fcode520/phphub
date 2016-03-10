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
        console.log('aaaaaaaaaa');
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
function vaild_mail(id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var posturl='vaild_email/'+id ;
    $.ajax({
        url: posturl,
        type: 'POST',
        data: {_token: CSRF_TOKEN},
        dataType: 'html',
        success: function (data) {
            if(data.status==true){
                alert("You pressed OK!");
                console.log(data);
            }else{
                alert("You pressed Not OK!");
                console.log(data);
            }

        }

    });
}


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

$(function() {
    try{
        var options =
        {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: $('.imageBox').attr('date')
        }

        var cropper = $('.imageBox').cropbox(options);

        $('#file').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
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
        $('#btnCrop').on('click', function () {
            var img = cropper.getDataURL();
            if(img=='noimg'){
                alert('请上传正确格式的图片');
                return ;
            }
            $('.cropped >img ').remove();
            $('.cropped').append('<img src="' + img + '">');
        })
        $('#btnZoomIn').on('click', function () {
            cropper.zoomIn();
        })
        $('#btnZoomOut').on('click', function () {
            cropper.zoomOut();
        })
    }catch(err){

    }


});
$(function(){
    $('.submitavatar').on('click',function(){

        var img=$('.cropped >img');
        var imgdata='';
        if(img.length<1) {
            $('#btnCrop').click();
            img=$('.cropped >img');
        }
        imgdata=img.attr('src');
        var CSRF_TOKEN = Config['token'];
        var posturl='/account/changeheader' ;

        $.ajax({
            url: posturl,
            type: 'POST',
            data: {_token: CSRF_TOKEN,imgdata:imgdata},
            dataType: 'html',
            success: function (data) {
                if(data=="false"){
                    alert("You pressed faild!");

                }else{
                    alert("You pressed ok!");
                    window.location.reload(true)
                    //$('#PopDialog').errorPOP();
                }

            }

        });


    })
});