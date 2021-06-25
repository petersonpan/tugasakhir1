<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductAttrController;
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
Route::post('/admin/login',[App\Http\Controllers\AdminController::class,'submit_login'])->name('auth.check');
Route::get('/admin/logout',[App\Http\Controllers\AdminController::class,'logout']);

Route::prefix('admin')->middleware('isAdminLogged')->group(function(){
	Route::get('/dashboard',[App\Http\Controllers\AdminController::class,'dashboard']);
	//Route::get('/user',[App\Http\Controllers\AdminController::class,'users']);
	Route::get('/categories/jsonCat',[App\Http\Controllers\CategoryController::class,'jsonCategory']);
	Route::resource("/categories", CategoryController::class);
	Route::resource("/products", ProductController::class);
	Route::resource("/roles", RolesController::class);
	Route::resource("/user", UserController::class);
	Route::resource("/product_attr", ProductAttrController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/roles', [App\Http\Controllers\PermissionController::class,'Permission']);
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
