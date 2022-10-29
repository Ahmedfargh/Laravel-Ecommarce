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
            return view("index",["adminName"=>$admin->get("name")[0]["name"]]);
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
            $response=[
                "status"=>1,
                "message"=>"تمت إضافة الأدمن "+$new_admin->name+""
            ];
        }catch(Exception $ex){
            $response=[
                "status"=>0,
                "message"=>"لم تتم عملية أضافة الأدمن بنجاح"
            ];
        }
        return json_decode($response);
    }
}
