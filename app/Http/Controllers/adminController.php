<?php
namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Products;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\chat;
use App\Models\order;
/*
*this class is to handle all admin operations
*/
class adminController extends Controller
{
    //admin login method return to index view if is done or get back to login
    function login(Request $req){
        $admin=DB::select("SELECT name,password,id,img FROM admins where name='{$req->get("adminname")}' AND password='{$req->get("password")}';");
        if(count($admin)==1){
            $_SESSION["admin_id"]=$admin[0]->id;
            return view("index",["adminName"=>$admin[0]->name,"profile_img"=>$admin[0]->img,"Type"=>"no"]);
        }
        return view("login");
    }
    /*
    *add admin functionality 
    */
    function add_admin(Request $req){
        $response=[];
        try{
            $new_admin=new Admin;
            $new_admin->name=$req->input("AdminName");
            $new_admin->email=$req->input("AdminEmail");
            $new_admin->added_by=$_SESSION["admin_id"];
            $new_admin->password=$req->input("Adminpassword");
            $new_admin->save();
            // json_encode($array);
        }catch(Exception $ex){
            return "fail";
        }
        return "done";
    }
    function get_all(Request $req){
        $admins=new Admin;
        return response()->json(Admin::all());
    }
    function count_admins(Request $req){
        return json_encode([0=>DB::table("admins")->count(),1=>DB::table("clients")->count(),2=>DB::table("carts")->count()]);
    }
    function load_admin_data(){
        if(isset($_SESSION["admin_id"])){
            $admin=DB::select("SELECT name,img,added_by,password,email,id FROM admins WHERE id={$_SESSION["admin_id"]}");
            return ["adminName"=>$admin[0]->name,"profile_img"=>$admin[0]->img,"Type"=>"Product","Categories"=>$this->get_all_categories(),"admin"=>$admin];
        }else{
            return false;
        }
    }
    function get_to_product_page(Request $req){
        $admin_data=$this->load_admin_data();
        if($admin_data){
            return view("products",$admin_data);
        }else{
            return view("login");
        }
    }
    function add_product(Request $req){
        $file=$req->file("Product_img")->move("public/img/product/");
        $product=new Products;
        $product->name=$req->get("productname");
        $product->price=$req->get("product_price");
        $product->quantity=$req->get("Product_quantity");
        $product->cat_id=$req->get("parent_cat");
        $product->added_by=$_SESSION["admin_id"][0]["id"];
        $product->img=$file;
        $product->save();
        $returned_data=$this->load_admin_data();
        $returned_data["categories"]=$this->get_all_categories();
        return view("products",$returned_data);
    }
    function get_all_categories(){
        return category::all();
    }
    function search_product(Request $req){
        $key=$req->get("key");
        if($req->get("type")=="by_name"){
           
            return json_encode(DB::select("SELECT products.added_by,products.id,products.cat_id,products.name,products.price,products.quantity,products.cat_id,products.img FROM products WHERE name like '%{$key}%'"));
        }else if($req->get("type")=="by_cat"){
            return json_encode(DB::select("SELECT products.added_by,products.id,products.cat_id,products.name,products.price,products.quantity,products.cat_id,products.img FROM products JOIN categorys where products.cat_id=categorys.id and categorys.id ={$key};"));
        }else if($req->get("type")=="by_added_by"){
            //var_dump(DB::select("SELECT * FROM products join admins WHERE products.added_by=admins.id and admins.name like '%+{$req->get("key")}+%';"));
            return json_encode(DB::select("SELECT products.added_by,products.id,products.cat_id,products.name,products.price,products.quantity,products.cat_id,products.img FROM products join admins WHERE products.added_by=admins.id and admins.name like '%{$key}%' ;"));
        }
        return json_encode(["message"=>"أرجو أختيار نوع البحث "]);
    }
    function update_product(Request $req){
        $update_col=$req->get("type");
        $product=Products::find($req->get("pro_id"));
        if($update_col=="name"){
            $product->name=$req->get("value");
        }else if($update_col=="price"){
            $product->price=$req->get("value");
        }else if($update_col=="cat_id"){
            $product->cat_id=$req->get("value");
        }
        $product->save();
        return json_encode(["message"=>1]);
    }
    function update_product_img(Request $req){
        $file=$req->file("product_img")->move("public/img/product/");
        $product=Products::find($req->get("product_id"));
        $product->img=$file;
        $product->save();
        $returned_data=$this->load_admin_data();
        $returned_data["categories"]=$this->get_all_categories();
        return view("products",$returned_data);
    }
    function delete_product(Request $req){
        Products::destroy($req->get("id"));
        return json_encode(["delete status"=>"تمت عملية المسح"]);
    }
    function get_to_my_Account_details(Request $req){
        $data=$this->load_admin_data();
        if($data){
            return view("admin-account",$this->load_admin_data());
        }
        return view("login");
    }
    function update_by_data(Request $req){
        $admin=Admin::find($_SESSION["admin_id"]);
        if($req->get("col")=="name"){
            $admin->name=$req->get("value");
        }else if($req->get("col")=="email"){
            $admin->email=$req->get("value");
        }else if($req->get("col")=="password"){
            $admin->password=$req->get("value");
        }
        $admin->save();
        return json_encode(["update_admin_status"=>"تمت عملية التحديث بنجاح"]);
    }
    function update_admin_img(Request $req){
        $admin=Admin::find($_SESSION["admin_id"]);
        $file=$req->file("new_admin_picture")->move("public/img/portfolio/");
        $admin->img=$file;
        $admin->save();
        return redirect("/admin/account/setting");
    }
    function count_admin_actions(Request $req){
        $data=[];
        $admins_Added=DB::select("SELECT COUNT(*) as counter from admins WHERE added_By={$_SESSION["admin_id"]}");
        $product_added=DB::select("SELECT COUNT(*) as counter from products HERE added_By={$_SESSION["admin_id"]}");
        $data["admins_added"]=$admins_Added[0]->counter;
        $data["product_Added"]=$product_added[0]->counter;
        return json_decode($data);
    }
    function get_to_category(Request $req){
        if(isset($_SESSION["admin_id"])){
            return view("categorys",$this->load_admin_data());
        }
        return view("login");
    }
    function get_cats_data(){
        return DB::table("categorys")->join("categorys");
    }
    function add_category(Request $req){
        $cat=new category;
        $cat->name=$req->get("category_name");
        if($req->get("parent_Class")!=0){
            $cat->parent_cat=$req->get("parent_Class");
        }
        $cat->save();
        return view("categorys",$this->load_admin_data());
    }
    function update_category(Request $req){
        $cat=category::find($req->get("id"));
        if($req->get("col")=="name"){
            $cat->name=$req->get("value");
        }else if($req->get("col")=="parent_cat"){
            $cat->parent_cat=$req->get("value");
        }
        $cat->save();
        return json_encode(["update_cat_Status"=>"تمت عملية تحديث التصنيف بنجاح"]);
    } 
    function delete_category(Request $req){
        category::destroy($req->get("id"));
        return json_encode(["delete_Status"=>"تمت عملية حذف التصنيف بنجاح"]);
    }
    function admin_posts(Request $req){
        $data=$this->load_admin_data();
        $data["posts"]=DB::select("SELECT admins.name as name,posts.writer,posts.post_id,posts.wrote_on as post_date,posts.post as post_cotent from posts,admins where posts.writer=admins.id");
        $data["admins"]=DB::select("SELECT admins.name as adm_name,admins.id as adm_id from admins");
        return view("posts",$data);
    }
    function publish_post(Request $req){
        $post=new post;
        $post->post=$req->get("post_content");
        $post->writer=$_SESSION["admin_id"];
        $post->save();
        return json_encode(["publish_post"=>"تم أرسال الرسالة لجميع الأمنز"]);
    }
    function get_chat(Request $req){
        $chat=DB::select("SELECT wrote_in,sender,reciever,chat_content from chat where (sender={$req->get("sender")} and reciever={$_SESSION['admin_id']})or(reciever={$req->get("sender")} and sender={$_SESSION['admin_id']})ORDER BY wrote_in asc;");
        return json_encode($chat);
    }
    function send_message(Request $req){
        $chat=new chat;
        $chat->chat_content=$req->get("chat_content");
        $chat->sender=$_SESSION["admin_id"];
        $chat->reciever=$req->get("reciver");
        $chat->save();
        return json_encode(["status"=>1]);
    }
    function get_order_pages(Request $req){
        $data=$this->load_admin_data();
        $data["uncheckiedOrders"]=DB::select("SELECT * FROM orders where is_checked=0");
        $data["order_status"]=DB::select("SELECT clients.name as client_name,clients.email as client_email,clients.phone as client_phone,orders.order_status as order_status FROM orders,clients,carts where clients.id=carts.by_client and carts.cart_id=orders.cart_id ");
        $data["ready_orders"]=DB::select("SELECT * FROM orders where order_status=1");
        $data["shipped_order"]=DB::select("SELECT * FROM orders where order_status=2");
        return view("orders",$data);
    }
}
