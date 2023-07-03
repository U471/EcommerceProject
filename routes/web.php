<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductBookingController;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('admin/dashboard',[adminController::class,'Dashboard']);

Route::get('/home',[BaseController::class,'home'])->name('home');
Route::get('/specialsOffer',[BaseController::class,'specialsOffer'])->name('specialsOffer');
Route::get('/delivery',[BaseController::class,'delivery'])->name('delivery');
Route::get('/contact',[BaseController::class,'contact'])->name('contact');
Route::get('/cart',[BaseController::class,'cart'])->name('cart');
Route::get('/productView/{id}',[BaseController::class,'productView'])->name('productView');
Route::get('/user/login',[BaseController::class,'userLogin'])->name('userLogin');
Route::post('/user/register',[BaseController::class,'userStore'])->name('userStore');
Route::Post('/user/login',[BaseController::class,'loginCheck'])->name('loginCheck');
Route::get('user/logout',[BaseController::class,'logout'])->name('userLogout');

//================= Cart controller Route ==========
Route::post('cart/store',[CartController::class,'store'])->name('cartStore');
Route::get('cart/delete/{id}',[CartController::class,'destroy'])->name('cart.delete');

//================ product BOOKING controller ================
Route::post('/product/booking',[ProductBookingController::class,'sto re'])->name('productbooking');
Route::get('/product/bookingFail',[ProductBookingController::class,'bookingFail'])->name('bookingFail');
Route::get('/product/bookingSuccess',[ProductBookingController::class,'bookingSuccess'])->name('bookingSuccess');



//================ Admin Route =====================
Route::get('admin/login',[adminController::class,'login'])->name('admin.login');
Route::Post('/admin/login',[adminController::class,'makeLogin'])->name('admin.makeLogin');




  


Route::group(['middleware'=>'auth'],function(){

   // Route::get('admin/dashbord',[adminController::class,'dashboard'])->name('admin.dashboard');
   Route::get('admin/dashboard',[adminController::class,'Dashboard']);
    Route::get('admin/logout',[adminController::class,'logout'])->name('admin.logout');

    //category controller route 

    Route::get('/categories',[CategoryController::class,'index'])->name('category.list');
    Route::get('/category/add',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/add',[CategoryController::class,'store']);
    Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/categories/edit',[CategoryController::class,'update'])->name('category.update');
    Route::post('/category/delete',[CategoryController::class,'destroy'])->name('category.detete');

    //============ Product Controller Route ======================
Route::get('/products',[ProductController::class,'index'])->name('product.list');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product/create',[ProductController::class,'store'])->name('product.store');
Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/product/edit',[ProductController::class,'update'])->name('product.update');
Route::get('/product/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
Route::get('/product/details/{id}',[ProductController::class,'extraDetails'])->name('product.extraDetails');
Route::post('/product/details',[ProductController::class,'extraDetailStore'])->name('product.extraDetailStore');

//user Controller route

Route::get('/admin/user',[userController::class,'index'])->name('User');
Route::get('/admin/delete/{id}',[userController::class,'destroy'])->name('user.delete');


});

