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
        $file=$req->file("Product_img")->store("images");
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
        if($req->get("type")=="by_name"){
            return json_encode(DB::select("SELECT * FROM products WHERE name like '%"+$req->get("key")+"%'"));
        }else if($req->get("type")=="by_cat"){
            return json_encode(DB::select("SELECT * FROM products JOIN categorys where products.cat_id=categorys.id and categorys.name like '%"+$req->get("name")+"%'"));
        }else if($req->get("type")=="by_added_by"){
            return json_encode(DB::select("SELECT * FROM products join admin WHERE products.added_by=admins.id and admins.name '%"+$req->get("key")+"%';"));
        }
    }
}
