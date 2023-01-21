<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Creator\CreatorController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TemplateController;

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



Route::middleware(['admin', 'verified', 'auth'])->prefix('/admin')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('admin');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // profile
    Route::prefix('/users')->group(function () {
        Route::get('admin', [AdminController::class, 'admin']);
        Route::get('admin-details', [AdminController::class, 'admin_details'])->name('admin-details');
    });
    Route::get('/profile/{id}', [AdminController::class, 'profile']);
    // Route::get('/edit-profile',[AdminController::class,'edit_profile'])->name('edit_profile');
    // Route::post('/profile_update' , [AdminController::class, 'update_profile'])->name('profile_update');
    Route::match(['get', 'post'], 'edit-profile/{id?}', [AdminController::class, 'edit_profile']);
    Route::match(['get', 'post'], 'update-password/{id?}', [AdminController::class, 'update_password']);

    //section
    Route::get('section', [SectionController::class, 'section'])->name('section');
    Route::get('edit_section/{id}', [SectionController::class, 'edit_section']);
    Route::post('/section_update/{id}', [SectionController::class, 'update_section']);
    Route::get('delete-section/{id}', [SectionController::class, 'delete_section']);
    Route::post('update-section-status', [SectionController::class, 'update_status']);
    //category
    Route::get('categories', [CategoryController::class, 'category'])->name('category');
    Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'delete_category']);
    Route::post('update-category-status', [CategoryController::class, 'update_status']);
    Route::post('append-categories-level', [CategoryController::class, 'append_categories_level']);
    //template
    Route::get('template', [TemplateController::class, 'template'])->name('template');
    Route::post('update-template-status', [TemplateController::class, 'update_status']);
    Route::get('delete-template/{id}', [TemplateController::class, 'delete_template']);
    Route::match(['get', 'post'], 'add-edit-template/{id?}', [TemplateController::class, 'addEditTemplate']);
    //product
    Route::get('products', [ProductController::class, 'product'])->name('product');
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
    //user
    Route::prefix('/users')->group(function () {
        Route::get('creator', [UserController::class, 'creator'])->name('creator');
        Route::get('customer', [UserController::class, 'customer'])->name('customer');
    });
    Route::prefix('/orders')->group(function () {
        Route::get('{title}', [OrderController::class, 'index']);
        Route::get('detail/{id}', [OrderController::class, 'detail']);
    });
});
