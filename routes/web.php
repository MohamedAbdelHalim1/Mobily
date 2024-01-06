<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/add_fav', [HomeController::class, 'index_fav'])->name('favfromhome');
Route::post('/del_fav', [HomeController::class, 'index_del_fav'])->name('delfavfromhome');

Route::get('/auth/facebook', [SocialController::class , 'redirect'])->name('facebook');
Route::get('/auth/facebook/callback', [SocialController::class , 'callback'])->name('facebook_callback');


Route::get('/model/{id}', [HomeController::class, 'specific_model'])->name('model');
Route::get('/more-details/{id}' ,[HomeController::class, 'more_details'])->name('more_details');
Route::post('/add_review/{id}',[HomeController::class, 'add_review'])->name('add_review');
Route::post('/model/{id}',[HomeController::class, 'filter_product'])->name('filter_product');

Route::post('/add_fav', [HomeController::class, 'index_fav'])->name('fav');
Route::post('/del_fav', [HomeController::class, 'index_del_fav'])->name('delfav');
Route::get('/fav_product', [HomeController::class, 'fav_product'])->name('fav_product');
Route::get('/mycart', [HomeController::class, 'cart'])->name('mycart');
Route::post('/add-cart', [HomeController::class, 'add_cart'])->name('add-cart');
Route::post('/del-cart', [HomeController::class, 'del_cart'])->name('del-cart');
Route::post('/mycart', [HomeController::class, 'totalprice_cart'])->name('totalprice_cart');

Route::get('/search/{value?}', [HomeController::class, 'search'])->name('search');
Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::post('/delete_history_item/{id}', [HomeController::class, 'history_item_del']);
Route::post('/delete_history_all', [HomeController::class, 'history_del_all']);
Route::get('/checkout/{total}/{quantity}',[HomeController::class ,'checkout'])->name('checkout');
Route::post('/checkout/{total}/{quantity}', [HomeController::class, 'shipping'])->name('shipping');
Route::post('/checkout', [HomeController::class, 'order_details'])->name('order_details');


