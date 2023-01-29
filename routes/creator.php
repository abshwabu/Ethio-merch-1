<?php

use App\Http\Controllers\Creator\CreatorController;
use App\Http\Controllers\Creator\PaymentController;
use App\Http\Controllers\Creator\StatisticsController;
use App\Http\Controllers\Creator\ShopController;
use App\Http\Controllers\Creator\TemplateController;
use App\Http\Controllers\Creator\CategoryController;
use App\Http\Controllers\Creator\ProductController;
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

Route::middleware(['verified', 'auth', 'creator'])->prefix('/creator')->group(function () {
    Route::get('', [CreatorController::class, 'index']);
    Route::get('dashboard', [CreatorController::class, 'dashboard']);
    Route::post('update-avatar/{id}', [CreatorController::class, 'update_avatar']);
    Route::match(['get', 'post'], 'personal-information/{id?}', [CreatorController::class, 'personal_information']);
    Route::match(['get', 'post'], 'account-setting/{id?}', [CreatorController::class, 'account_setting']);

    //category
    Route::get('categories', [CategoryController::class, 'category']);
    Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'delete_category']);
    Route::post('update-category-status', [CategoryController::class, 'update_status']);
    Route::post('append-categories-level', [CategoryController::class, 'append_categories_level']);
    //product
    Route::get('products', [ProductController::class, 'product']);
    Route::get('delete-product/{id}', [ProductController::class, 'delete_product']);
    Route::post('update-product-status', [ProductController::class, 'update_status']);
    Route::post('update-product-is_featured', [ProductController::class, 'update_is_is_featured']);
    Route::post('delete-product-image/{id}', [ProductController::class, 'delete_product_image']);
    Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductController::class, 'addEditProduct']);
    //Attributes
    Route::match(['get', 'post'], 'add-attributes/{id?}', [ProductController::class, 'addAttributes']);
    Route::post('edit-attributes/{id}', [ProductController::class, 'editAttributes']);
    Route::post('update-attribute-status', [ProductController::class, 'update_attribute_status']);
    Route::get('delete-attribute/{id}', [ProductController::class, 'delete_attribute']);
    //images
    Route::match(['get', 'post'], 'add-images/{id?}', [ProductController::class, 'addImages']);
    Route::post('update-image-status', [ProductController::class, 'update_image_status']);
    Route::get('delete-image/{id}', [ProductController::class, 'delete_image']);
    //payment-data
    Route::get('payment-data', [PaymentController::class, 'payment_data']);
    Route::post('add-edit-payment-data/{id}', [PaymentController::class, 'add_edit_payment']);
    //statistics
    Route::get('statistics', [StatisticsController::class, 'index']);
    //Designs
    Route::get('templates', [TemplateController::class, 'index']);
    //shop
    Route::get('shop', [ShopController::class, 'index']);
});
