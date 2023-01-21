<?php

use App\Http\Controllers\Creator\CreatorController;
use App\Http\Controllers\Creator\PaymentController;
use App\Http\Controllers\Creator\StatisticsController;
use App\Http\Controllers\Creator\ProductController;
use App\Http\Controllers\Creator\ShopController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['verified','auth','creator'])->prefix('/creator')->group(function(){
Route::get('',[CreatorController::class,'index']);
Route::get('dashboard',[CreatorController::class,'dashboard']);
Route::post('update-avatar/{id}',[CreatorController::class,'update_avatar']);
Route::match(['get','post'], 'personal-information/{id?}',[CreatorController::class,'personal_information']);
Route::match(['get','post'], 'account-setting/{id?}',[CreatorController::class,'account_setting']);

//payment-data
Route::get('payment-data',[PaymentController::class,'payment_data']);
Route::post('add-edit-payment-data/{id}',[PaymentController::class,'add_edit_payment']);
//statistics
Route::get('statistics',[StatisticsController::class,'index']);
//Designs
Route::get('templates',[ProductController::class,'index']);
//shop
Route::get('shop',[ShopController::class,'index']);


});