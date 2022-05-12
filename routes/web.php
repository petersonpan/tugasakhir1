<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductAttrController;
use App\Http\Controllers\ImageProductController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/admin',[App\Http\Controllers\AdminController::class,'login']);
Route::get('/admin/login',[App\Http\Controllers\AdminController::class,'login'])->middleware('AlreadyLoggedIn');
Route::post('/admin/login',[App\Http\Controllers\AdminController::class,'submit_login'])->name('adminauth.check');
Route::get('/admin/logout',[App\Http\Controllers\AdminController::class,'logout']);


Route::prefix('admin')->middleware(['isAdminLogged'])->group(function(){
	
		Route::get('/dashboard',[App\Http\Controllers\AdminController::class,'dashboard']);
		//Route::get('/user',[App\Http\Controllers\AdminController::class,'users']);
		Route::get('/categories/jsonCat',[App\Http\Controllers\CategoryController::class,'jsonCategory']);
		Route::resource("/categories", CategoryController::class);
		Route::resource("/products", ProductController::class);
		Route::resource("/roles", RolesController::class);
		Route::get("/permissions",[App\Http\Controllers\PermissionController::class,'Permission']);
		Route::resource("/user", UserController::class);
		Route::get('/view',[App\Http\Controllers\AdminController::class,'adminview'])->name('admin.view');
		Route::resource("/product_attr", ProductAttrController::class);
		Route::resource('/product-image',ImageProductController::class);
		Route::get('/product_attr/deleteattr/{id}',[App\Http\Controllers\ProductAttrController::class,'deleteattr'])->name('product_attr.deleteattr');
});



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/roles', [App\Http\Controllers\PermissionController::class,'Permission']);
Route::get('/category/{id}',[App\Http\Controllers\HomeController::class, 'ListByCat'])->name('cats');
Route::get('/product-detail/{id}',[App\Http\Controllers\HomeController::class, 'productDetails'])->name('productdetail');
