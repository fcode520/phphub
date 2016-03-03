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