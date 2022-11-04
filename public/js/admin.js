function ajax_contact(data,method,dataType,url){
    data_to_return=null;
    $.ajax({
        type:"GET",
        url:url,
        data:data,
        dataType:"json",
        success:function(data){
            alert(data);
            data_to_return=data;
            console.log(data);
        },
        failure:function(data){
            alert("تفقد الأتصال بالانترنت");
        }
    });
    return data_to_return;
}
function get_all_admins(){
    let data=ajax_contact({},"POST","json","/admin/get/all");
    console.log(data);
    alert("shit");
}
$(document).ready(function(){
    $("#btn_add_admin").on("click",function(){
        if($("#password").val()==$("#password_confirm").val()){
            sent_data={
                token:$("hidden").val(),
                AdminName:$("#AdminName").val(),
                AdminEmail:$("#AdminEmail").val(),
                Adminpassword:$("#password").val()
            }
            recived_data=ajax_contact(sent_data,"post","json","/admin/add");
            alert(recived_data);
        }else{
            alert("خطأ فى البيانات");
        }
    });
    var int =setTimeout(function(){
        get_all_admins();
    }, 3000);
});