function ajax_contact(data,method,dataType,url){
    data_to_return=null;
    $.ajax({
        type:"GET",
        url:url,
        data:data,
        dataType:dataType,
        success:function(data){
            data_to_return=data;
        },
        failure:function(data){
            alert("تفقد الأتصال بالانترنت");
        }
    });
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
        }else{
            alert("خطأ فى البيانات");
        }
    });
    
});