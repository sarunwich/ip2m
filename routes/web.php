<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\welcomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\OfferbuyController;
use App\Http\Controllers\ResponseOfferbuyController;
use App\Http\Controllers\ProductImagebuyController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [welcomeController::class, 'index']);
Route::get('/categories', [welcomeController::class, 'categories'])->name('categories');
Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
Route::post('/language-switch', [LangController::class, 'languageswitch'])->name('language.switch');
Route::post('/get-amphur', [DropdownController::class,'getAmphur'])->name('get.amphur');
Route::post('/get-district', [DropdownController::class,'getDistrict'])->name('get.district');
Route::post('/get-iptypedetail', [DropdownController::class,'getiptypedetail'])->name('get.iptypedetail');
Route::get('/showproduct/{id}', [welcomeController::class,'showproduct'])->name('showproduct');
Route::get('/showoffer/{id}', [welcomeController::class,'showoffer'])->name('showoffer');
Route::get('/findgroup/{id}', [welcomeController::class,'findgroup'])->name('findgroup');



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();
Auth::routes(['verify' => true]);
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth','verified', 'user-access:user'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('works', WorkController::class);
    Route::resource('seller', SellerController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('buy', OfferbuyController::class);
    Route::resource('response', ResponseOfferbuyController::class);
    Route::resource('productImagebuy', ProductImagebuyController::class);
    Route::resource('productImage', ProductImageController::class);
    Route::post('/products/{id}/like', [ProductController::class,'like'])->name('products.like');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'upprofile'])->name('user.profile');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'storeupprofile'])->name('user.profile.store');

     Route::post('work/create-step-one', [WorkController::class,'postCreateStepOne'])->name('work.create.step.one.post');
     Route::post('work/edit-step-one', [WorkController::class,'postEditStepOne'])->name('work.edit.step.one.post');
    Route::get('work/create-step-two', [WorkController::class ,'createStepTwo'])->name('user.works.create2');
    Route::get('work/edit-step-two', [WorkController::class ,'editStepTwo'])->name('user.works.edit2');
    Route::post('work/create-step-two', [WorkController::class ,'postCreateStepTwo'])->name('work.create.step.two.post');
    Route::post('work/edit-step-two', [WorkController::class ,'postEditStepTwo'])->name('work.edit.step.two.post');
    Route::post('/get-category', [DropdownController::class,'getCategory'])->name('get.category');
    Route::get('changeStatus', [ProductController::class ,'changeStatus'])->name('user.changeStatus');
    Route::get('upreadApp', [AppointmentController::class ,'upreadApp'])->name('user.upreadApp');
    Route::get('/findtype/{id}', [HomeController::class,'findtype'])->name('findtype');
    Route::get('changeSellStatus', [SellerController::class ,'changeSellStatus'])->name('user.changeSellStatus');
    

    
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::resource('offer', OfferController::class);
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/upStatus', [OfferController::class ,'upStatus'])->name('admin.upStatus');
     Route::get('/offers/buy', [OfferController::class ,'offerBuy'])->name('offer.buy');
    Route::get('upstatusoffer', [OfferController::class ,'upstatusoffer'])->name('admin.upstatusoffer');
    Route::get('/offer/{id}/show', [OfferController::class ,'offerShow'])->name('offer.show');
    Route::post('/calendar/update', [OfferController::class, 'update'])->name('admin.calendar.update');
    // Route::get('offerx/buy', function () {
//     return view('welcome');
// });

});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
