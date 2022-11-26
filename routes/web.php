<?php


use App\Http\Controllers\Creator\LoginController;
use App\Http\Controllers\Creator\RegisterController;
use App\Http\Livewire\HomeCompnent;
use App\Http\Livewire\ShopeComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CatagoryComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ThankyouComponent;
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
// Auth::routes(['verify'=>true]);

Route::get('/welcom', function () {
    return view('welcome');
});
Route::get('/location', function () {
    return view('location');
});

Route::get('/',HomeCompnent::class);
Route::get('/shop',ShopeComponent::class);
Route::get('/cart',CartComponent::class)->name('product.cart');
Route::get('/checkout',CheckoutComponent::class)->name('checkout');
Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');
Route::get('category/{section}/{slug}',CatagoryComponent::class)->name('product.category');
Route::get('/search',SearchComponent::class)->name('product.search');
Route::get('/wishlist',WishlistComponent::class)->name('product.wishlist');
Route::get('/thankyou-page',ThankyouComponent::class)->name('thankyou');
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
// for user
Route::middleware('guest')->prefix('/creator')->group(function(){
Route::get('login',[LoginController::class,'create']);
Route::post('login',[LoginController::class,'store']);
Route::get('register',[RegisterController::class,'create']);
Route::post('register',[RegisterController::class,'store']);
});
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
require __DIR__.'/admin.php';
require __DIR__.'/creator.php';
require __DIR__.'/auth.php';
