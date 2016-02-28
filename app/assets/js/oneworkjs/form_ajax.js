$(document).ready(function () {

    $('#mysubmit').click(function() {
        $.ajax({
            type:"POST",
            async:false,//异步请求  默认为true,设置为false的话,suncess之后，才会继续执行  下面的js
            data:$('#changepwd').serialize(),// 你的formid
            url:"/account/changepassword",
            success:function(msg){
                alert(msg);
            },
            error:function(msg){
                alert(msg);
            }

        });
    });
    $('#register_button').click(function(){

    });
});

