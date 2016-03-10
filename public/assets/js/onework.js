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

(function(){
    var fileInput = $('#demo-file');
    var fileLabel;
    var img;
    $("#demo-preview").hide();
    if (typeof window.FileReader === 'function' || typeof window.FileReader === 'object') {
        var oFile = new FileReader();
        var passFileType = /^(?:image\/bmp|image\/gif|image\/jpeg|image\/png)$/i;

        oFile.onloadend = function(oFREvent){

            var state = oFREvent.currentTarget.readyState;
            if (state === 2) {   //图片加载成功

                if(typeof(img)!="undefined"){
                    img.destroy();           //如果存在Jcrop，将其移除
                }
                if(typeof(fileLabel)!="undefined"){
                    $(fileLabel).remove();    //如果已经存在img标签，将其移除
                }
                fileLabel=document.createElement("img");
                document.getElementById("demo-preview").appendChild(fileLabel);  //创建一个img标签，并将图片显示在页面中

                $(fileLabel).attr('src',oFREvent.target.result);

                $("#demo-preview").show();
                $(fileLabel).Jcrop({          //初始化jcrop
                    allowSelect:false,
                    aspectRatio:1,
                    onSelect:initData,        //选框完成选择是触发initData函数
                },function(){
                    img=this;
                    img.setSelect([0,0,50,50]);
                    $("#subImg").show();
                });
            }
        };

        fileInput.on('change', function(e){
            if (!e.target || !e.target.files.length || !e.target.files[0]) {return};
            var _file = e.target.files[0];
            if (!passFileType.test(_file.type)) {return};
            oFile.readAsDataURL(_file);
        });
    };

    function initData(data){    //将选框信息存储到form中的编辑框中

        $("#ix").val(data.x);   //选框开始横坐标
        $("#iy").val(data.y);   //选框开始
        $("#iw").val(data.w);   //选框的宽度
        $("#ih").val(data.h);   //选框的高度
    }

})();

function saveIcon(){
    $("#fileSubmit").submit();   //讲form表单提交到crop.php进行处理
}


//		function huoqu(){
//			var img = $("#demo-preview img"); // Get my img elem
//			var pic_real_width, pic_real_height;
//			$("<img/>") // Make in memory copy of image to avoid css issues
//			    .attr("src", img.eq(0).attr("src"))
//			    .load(function() {
//			        pic_real_width = this.width;   // Note: $(this).width() will not
//			        pic_real_height = this.height; // work for in memory images.
//			        alert(pic_real_width+ "  "+pic_real_height);
//			    });
//					}
