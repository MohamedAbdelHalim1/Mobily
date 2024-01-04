<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\auth\AdminLoginController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/



// home page once admin make login
Route::get('/home',[AdminHomeController::class , 'index'])->middleware('auth:admin')->name('admin.home');  //we here select specific guard from two guard we made in config->auth
//Route return view of login
Route::get('/login',[AdminLoginController::class , 'admin_login'])->name('admin.login');
//Route after submit login
Route::post('/login',[AdminLoginController::class , 'check_login'])->name('admin.checklogin');
Route::post('/logout', [AdminLoginController::class , 'logout'])->name('admin.logout');
////////////////////start user///////////////////////////
Route::get('/get_users' , [AdminHomeController::class , 'get_users'])->name('admin.access.users');
Route::post('/edit_user/{id}', [AdminHomeController::class , 'edit_user'])->name('admin.update.user');
Route::post('/delete_user/{id}', [AdminHomeController::class , 'remove_user'])->name('admin.remove.user');
Route::post('/add_user/', [AdminHomeController::class , 'add_user'])->name('admin.add.user');
/////////////////////start category/////////////////////////
Route::get('/categories',[AdminHomeController::class , 'get_category'])->name('admin.categories');
Route::post('/edit_category/{id}', [AdminHomeController::class , 'edit_category'])->name('admin.edit.category');
Route::post('/delete_category/{id}' , [AdminHomeController::class , 'delete_category'])->name('admin.delete.category');
Route::post('/add_category/', [AdminHomeController::class , 'add_category'])->name('admin.add.category');
//////////////////start products//////////////////////////
Route::get('/products/{id}',[AdminHomeController::class , 'get_product'])->name('admin.products');
Route::get('/add_product/', [AdminHomeController::class , 'add_product'])->name('admin.add_product');
Route::post('/add_product/', [AdminHomeController::class , 'upload_product'])->name('admin.uploadproduct');

Route::get('/edit_product/{id}', [AdminHomeController::class , 'edit_product'])->name('admin.editproduct');

Route::delete('/deleteimage/{id}',[AdminHomeController::class , 'delete_image'])->name('admin.deleteimage');
Route::post('/edit_product/{id}', [AdminHomeController::class , 'edit_upproduct'])->name('admin.editUpproduct');

Route::delete('/delete_product/{id}',[AdminHomeController::class , 'delete_product'])->name('admin.deleteproduct');