<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::POST('/',[adminController::class,"login"] )->name("index_page");
Route::get("/login",function(){
    return view("login");
})->name("loginpage");
Route::get("/admin/add",[adminController::class,"add_admin"])->name("add_admin");
Route::get("/admin/get/all",[adminController::class,"get_all"])->name("get_admins_all");
Route::get("/admin/get/count",[adminController::class,"count_admins"])->name("count_admins");
Route::get("/admin/product/page",[adminController::class,"get_to_product_page"])->name("product_page");
