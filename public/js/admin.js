function get_all_admins(data,method,dataType,url){
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
            console.log(data);
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
function render_product_search(data){
    let html="";
    html+="<tr>";
    html+="<td>الأسم</td>";
    html+="<td>رقم المنتج</td>";
    html+="<td>السعر</td>";
    html+="<td>الكمية المتاحة</td>";
    html+="<td>رقم التصنيف</td>";
    html+="<td>تمت الأأضافة بواسطة</td>";
    html+="<td>صورة للمنتج</td>";
    html+-"</tr>";
    console.log(data);
    for(let product in data){
        console.log(product);
        html+="<tr>";
        html+="<td>"+data[product]["name"]+"</td>";
        html+="<td>"+data[product]["id"]+"</td>";
        html+="<td>"+data[product]["price"]+"</td>";
        html+="<td>"+data[product]["quantity"]+"</td>";
        html+="<td>"+data[product]["cat_id"]+"</td>";
        html+="<td>"+data[product]["added_by"]+"</td>";
        html+='<td><a href="/'+data[product]['img']+'">أضغط هنا لروية الصورة</a></td>';
        html+="</tr>";
    }
    $("#look_for_products").html(html);
}
function look_for_product(type,key){
    $.ajax({
        url:"/admin/product/search",
        data:{_token:$("hidden").val(),type:type,key:key},
        dataType:"json",
        success:function(data){
            render_product_search(JSON.parse(JSON.stringify(data)));
        },
        failure:function(data){
            alert("فشلت عملية البحث");
        }
    });
}
function update_product(type,value,id){
    $.ajax({
        url:"/admin/product/update",
        data:{_token:$("hidden").val(),type:type,value:value,pro_id:id},
        dataType:"json",
        success:function(data){
            data=JSON.parse(JSON.stringify(data));
            if(data["message"]==1){
                alert("done");
            }
        },
        statusCode:{
            404:function(){
                alert("أفحص الأتصال بالانترنت");
            },
            500:function(){
                alert("خطأ فى برمجيات الخادم");
            }
        }
    });
}
function delete_product(pro_id){
    $.ajax({
        url:"/admin/product/delete",
        data:{_token:$("hidden").val(),id:pro_id},
        dataType:"json",
        success:function(data){
            data=JSON.parse(JSON.stringify(data))
            alert(data["delete status"]);
        },
        statusCode:{
            404:function(){
                alert("أفحص أتصالك بالانترنت");
            },
            500:function(){
                alert("خطأ فى برمجيات الخادم");
            }
        }
    });
}
function update_admin_field(col,value){
    $.ajax({
        url:"/admin/update",
        data:{_token:$("hidden").val(),col:col,value:value},
        dataType:"json",
        success:function(data){
            data=JSON.parse(JSON.stringify(data));
            alert(data["update_admin_status"]);
            window.location=document.location;
        },
        statusCode:{
            404:function(){
                alert("أفحص أتصاللك بالأنترنت");
            },
            500:function(){
                alert("خطأ فى برمجيات الخادم");
            }
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
            alert(recived_data);
        }else{
            alert("خطأ فى البيانات");
        }
    });
    if($("#admins_table")){
        var int =setInterval(function(){
            get_all_admins_caller();
        }, 1000);
        var counter_timer=setInterval(function(){
            get_counters();
        },1000)
        alert("done");
    }
    else if($("#look_for_products")){
        
    }
    $("#btn_search_name").on("click",function(){
        look_for_product("by_name",$("#key_name").val());
    });
    $("#key_Category").on("click",function(){
        look_for_product("by_cat",$("#key_Category").val());
    });
    $("#btn_search_added_by").on("click",function(){
        look_for_product("by_added_by",$("#key_added_by").val());
    });
    $("#update_product_name").on("click",function(){
        let pro_id=$("#product_id").val();
        let value=$("#new_update_product").val();
        if(pro_id==null || pro_id==undefined ||pro_id==""){
            alert("رجاء أدخل رقم المنتج");
        }else{
            update_product("name",value,pro_id);
        }
    });
    $("#update_product_price").on("click",function(){
        let pro_id=$("#product_id").val();
        let value=$("#new_product_price").val();
        if(pro_id==null || pro_id==undefined ||pro_id==""){
            alert("رجاء أدخل رقم المنتج");
        }else{
            update_product("price",value,pro_id);
        }
    });
    $("#update_product_cat").on("click",function(){
        let pro_id=$("#product_id").val();
        let value=$("#update_cat").val();
        if(pro_id==null || pro_id==undefined ||pro_id==""){
            alert("رجاء أدخل رقم المنتج");
        }else{
            update_product("cat_id",value,pro_id);
        }
    });
    $("#delete_product").on("click",function(){
        delete_product($("#product_id").val());
    });
    $("#update_my_admin_name").on("click",function(){
        update_admin_field("name",$("#admin_name").val());
    });
    $("#update_my_admin_email").on("click",function(){
        update_admin_field("email",$("#myAdmin_email").val());
    });
    $("#update_my_admin_password").on("click",function(){
        let old_password=$("#old_password").val();
        let new_password=$("#new_password").val();
        if($("#old_password").val()==$("#new_password").val()||$("#new_password").val()==""||$("#new_password").val()==null ||$("#new_password").val()==undefined){
            alert("لايمكن تحديث الباسورد");
        }else{
            update_admin_field("password",$("#new_password").val());
        }
    });
    ajax_contact([],"POST","json","/admin/get/count");
});
