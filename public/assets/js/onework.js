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
    if(!!$('.banner-text').attr('data-time')){
        var time=$('.banner-text').attr('data-time');
        $('.banner-text').stop().animate({'height':50},300);
        setTimeout(function(){
            $('.banner-text').stop().animate({'height':0},300);
        },time)
    }
});
$(function(){//顶部头像 滑过后效果等
    var w = $('.header-info').find('ul').outerHeight();
    $('.header').hover(function(){
        $('.header-info').stop().animate({'height':w},300);
        $('.tiangle').fadeIn(100);
    },function(){
        $('.header-info').stop().animate({'height':0},300);
        $('.tiangle').fadeOut(300);
    });
    var t = $('.header-info > ul > li');
    var line = $('.header-info > p');
    var top = t.parent().find('.act').index()*28+10;
    line.css('top',top);
    t.on('click',function(){
        $(this).addClass('act').siblings().removeClass('act');
    });
    t.find('a').hover(function(){
        line.stop().animate({'top':$(this).parent().index()*28+10},300);
        $('.header-info > ul > .act > a').css({'color':'#666'});
    },function(){
        line.stop().animate({'top':t.parent().find('.act').index()*28+10},300);
        $('.header-info > ul > .act > a').css({'color':'#63ce83'});
    })
});
$(function(){//顶部导航
    var i = $('.nav > i');
    var t = $('.nav > li > a');
    var act = $('.nav > .act');
    i.css('width',t.width()+10);
    t.hover(function(){
        i.stop().animate({'left':$(this).parent().position().left+10,'width':$(this).width()+10},300);
        act.find('a').css({'color':'#777'});
    },function(){
        i.stop().animate({'left':act.position().left+10,'width':act.find('a').width()+10},300)
        act.find('a').css({'color':'#63ce83'});
    });
});