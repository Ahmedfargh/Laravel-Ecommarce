<?php
namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Products;
use App\Models\category;
use Illuminate\Support\Facades\DB;
class adminController extends Controller
{
    //admin login method
    function login(Request $req){
        $admin=Admin::where("name",$req->input("adminname"));
        if(count($admin->get("password"))==1){
            $_SESSION["admin_id"]=$admin->get("id");
            return view("index",["adminName"=>$admin->get("name")[0]["name"],"profile_img"=>$admin->get("img"),"Type"=>"no"]);
        }
        return view("login");
    }
    function add_admin(Request $req){
        $response=[];
        try{
            $new_admin=new Admin;
            $new_admin->name=$req->input("AdminName");
            $new_admin->email=$req->input("AdminEmail");
            $new_admin->added_by=$_SESSION["admin_id"][0]["id"];
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
            $admin=DB::select("SELECT name,img FROM admins WHERE id=?", [$_SESSION["admin_id"][0]["id"]]);
            return ["adminName"=>$admin[0]->name,"profile_img"=>$admin[0]->img,"Type"=>"Product","Categories"=>$this->get_all_categories()];
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
        $file=$req->file("Product_img")->move("public/img/product/");
        $product=Products::find($req->get("product_id"));
        $product->img=$file;
        $returned_data=$this->load_admin_data();
        $returned_data["categories"]=$this->get_all_categories();
        return view("products",$returned_data);
    }
}
