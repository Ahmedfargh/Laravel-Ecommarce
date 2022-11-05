﻿function get_all_admins(data,method,dataType,url){
    data_to_return="shit";
    data_to_return=$.ajax({
        type:"GET",
        url:url,
        data:data,
        dataType:"json",
        success:function(data){
            render_admin_table(JSON.parse(JSON.stringify(data)));
        },
        failure:function(data){
            alert("تفقد الأتصال بالانترنت");
        }
    });
    return data_to_return;
}
function ajax_contact(data,method,dataType,url){
    data_to_return="shit";
    data_to_return=$.ajax({
        type:"GET",
        url:url,
        data:data,
        dataType:"json",
        success:function(data){
            data=JSON.parse(JSON.stringify(data));
            $("#admin_counter").html("عدد الأدمن "+data[0]);
            $("#user_counters").html("عدد المستخدممين"+data[1]);
            $("#under_shopping_user").html("عدد المستخدمين الذين يتسوقون الأن"+data[2]);
        },
        failure:function(data){
            alert("تفقد الأتصال بالانترنت");
        }
    });
    return data_to_return;
}
function get_counters(){
    data=ajax_contact([],"POST","json","/admin/get/count");
    //console.log(data);
    
}
function render_admin_table(data){
    let html="";
    html+="<tr>";
    html+="<td>البريد الألكترونى</td>";
    html+="<td>تمت الأضافة بواسطة </td>";
    html+="<td>الرقم التعريفى</td>";
    html+="<td>الأسم</td>"
    html+="</tr>";
    let i=0;
    //data=data["responseJSON"]
    
    for(let admin in data){
        html+="<tr>";
        html+="<td>"+data[admin]["email"]+"</td>";
        html+="<td>"+data[admin]["added_by"]+"</td>";
        html+="<td>"+data[admin]["id"]+"</td>";
        html+="<td>"+data[admin]["name"]+"</td>";
        html+="</tr>";
    }
    $("#admins_table").html(html);
}
function get_all_admins_caller(){
    let data=get_all_admins({},"POST","json","/admin/get/all");
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
    var int =setInterval(function(){
        get_all_admins_caller();
    }, 1000);
    var counter_timer=setInterval(function(){
        get_counters();
    },1000);
});
/*

 */