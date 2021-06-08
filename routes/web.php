<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CuponController;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);
Route::get('home', function () {
    return view('admin.home');
});
Route::get('about', [App\Http\Controllers\FrontendController::class, 'about']);
Route::get('contact', [App\Http\Controllers\FrontendController::class, 'contact']);
Route::get('faq', [App\Http\Controllers\FrontendController::class, 'faq']);


Auth::routes(['verify' => true]);

Route::get('faq/home', [App\Http\Controllers\FaqController::class, 'index'])->name('home');
Route::post('faq/add', [App\Http\Controllers\FaqController::class, 'add']);
Route::get('faq/delete/{id}', [App\Http\Controllers\FaqController::class, 'delete']);
Route::get('faq/edit/{id}', [App\Http\Controllers\FaqController::class, 'edit']);
Route::post('faq/update', [App\Http\Controllers\FaqController::class, 'update']);
Route::get('faq/restore/{id}', [App\Http\Controllers\FaqController::class, 'restore']);
Route::get('faq/remove/{id}', [App\Http\Controllers\FaqController::class, 'remove']);
Route::get('admin/editprofile', [App\Http\Controllers\AdminController::class, 'show']);

Route::post('changepassword', [App\Http\Controllers\AdminController::class, 'changePassword'])->middleware('verified');

Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);

Route::get('customer/home', [App\Http\Controllers\CustomerController::class, 'home']);



Route::get('auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('auth/callback', function () {
    $user = Socialite::driver('github')->user();

    if(!User::where('email',$user->getEmail())->where('name','$user->getNickname()')->exists()){
        User::insert([
            'name'=>$user->getNickname(),
            'email'=>$user->getEmail(),
            'password'=>bcrypt('123'),
            'role'=>2,
            'created_at'=>Carbon::now(),
        ]);
    }

 

    if (Auth::attempt(['email' => $user->getEmail(), 'password' => '123'])) {
        
        return redirect('customer/home');
    }
  

    // $user->token
});




Route::get('auth/google/redirect', [App\Http\Controllers\GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'callback']);


Route::post('addtocart', [App\Http\Controllers\CartController::class, 'addtocart']);
Route::get('delete/from/cart/{cart_id}', [App\Http\Controllers\CartController::class, 'deletefromcart']);
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart']);
Route::post('update/cart', [App\Http\Controllers\CartController::class, 'updatecart']);

Route::resource('cupon',CuponController::class);

Route::get('cart/{cupon_name}', [App\Http\Controllers\CartController::class, 'cart']);