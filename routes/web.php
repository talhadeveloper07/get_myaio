<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\BusinessInformationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClosureController;




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


Route::get('/',['middleware' => 'guest', function () {
    return view('auth.login');
}]);

Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/add-business-details', [HomeController::class, 'add_business_view'])->name('add-business-details')->middleware('verified');
Route::get('/add-profile-details', [HomeController::class, 'add_profile_view'])->name('add-profile-details')->middleware('verified');
Route::get('/select-package', [PackageController::class, 'index'])->name('select-package')->middleware('verified');
Route::post('/add-radius',[BusinessInformationController::class,'business_info_radius'])->name('add-radius')->middleware('verified');
Route::get('/check-closure',[ClosureController::class,'check_closure'])->name('check-closure')->middleware('verified');
Route::post('/business-details-insert',[BusinessInformationController::class,'business_info_insert'])->name('business-details-insert')->middleware('verified');
// Route::get('/order/{id}',[OrderController::class,'order_view'])->name('order')->middleware('verified');
Route::post('/order-submit',[OrderController::class,'order_submit'])->name('order-submit')->middleware('verified');
Route::get('/order-completed',[OrderController::class,'ordercompleted'])->name('order-completed')->middleware('verified');
Route::get('/orderdetail/{id}',[HomeController::class,'customer_order_view'])->middleware('verified');
Route::post('/order',[OrderController::class,'order_view'])->name('order')->middleware('verified');
// Route::get('customer-view-order/{id}', [HomeController::class, 'customer_order_view']);

//edit business info

Route::get('/edit-business-details', [BusinessInformationController::class, 'updatebusiness'])->name('edit-business-details')->middleware('verified');
Route::post('/edit-radius',[BusinessInformationController::class,'business_info_update'])->name('edit-radius')->middleware('verified');
Route::post('/business-update',[BusinessInformationController::class,'business_update'])->name('business-update')->middleware('verified');


Route::controller(PaymentController::class)->group(function(){
    Route::get('checkout',[PaymentController::class,'stripe'])->name('checkout')->middleware('verified');
    // Route::get('stripe', 'stripe')->middleware('verified');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});


// paypal routes

Route::get('/paypal', [PayPalController::class, 'paypal'])->name('paypal');
Route::get('payment', [PayPalController::class,'payment'])->name('payment');
Route::get('cancel', [PayPalController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class,'success'])->name('payment.success');


// admin routes
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::get('allusers', [AdminController::class, 'userslist'])->name('allusers');
    Route::get('single-user/{id}', [AdminController::class, 'singleuser']);
    Route::get('orderslist', [AdminController::class, 'orderslist'])->name('orderslist');
    Route::get('view-order/{id}', [AdminController::class, 'order_invoice']);
    Route::get('invoice', [AdminController::class, 'invoice']);

});