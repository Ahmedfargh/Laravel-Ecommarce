<?php
namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use App\Models\Admin;
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
        return response()->json(Amind::all());
    }
}
