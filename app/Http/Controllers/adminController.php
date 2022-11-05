<?php
namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
class adminController extends Controller
{
    //admin login method
    function login(Request $req){
        $admin=Admin::where("name",$req->input("adminname"));
        if($admin->get("password")[0]["password"]==$req->input("password")){
            $_SESSION["admin_id"]=$admin->get("id");
            return view("index",["adminName"=>$admin->get("name")[0]["name"],"profile_img"=>$admin->get("img")]);
        }
        abort(403,"wrong data");
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
            $admin=Admin::where("id",$_SESSION["admin_id"]);
            return ["adminName"=>$admin->get("name"),"profile_img"=>$admin->get("img"),"Type"=>"Product"];
        }else{
            return false;
        }
    }
    function get_to_product_page(Request $req){
        $admin_data=$this->load_admin_data();
        if($admin_data){
            return view("products",$admin_data);
        }
    }
}
