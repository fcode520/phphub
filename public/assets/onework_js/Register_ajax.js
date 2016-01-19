/**
 * Created by Zoro on 2016/1/19.
 */
$(function(){

    //$(".send_valid_mail").click(function(){
    //
    //});
     function myfunc(a){
        console.log("myfuncmyfuncmyfunc");
        return a;
    }

});
function vaild_mail(url){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: 'vaild_email/'.url,
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