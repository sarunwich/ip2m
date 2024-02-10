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
Route::get('/categories', function () {
    return view('categories');
});
Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
Route::post('/language-switch', [LangController::class, 'languageswitch'])->name('language.switch');
Route::post('/get-amphur', [DropdownController::class,'getAmphur'])->name('get.amphur');
Route::post('/get-district', [DropdownController::class,'getDistrict'])->name('get.district');
Route::post('/get-iptypedetail', [DropdownController::class,'getiptypedetail'])->name('get.iptypedetail');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('works', WorkController::class);
    Route::resource('seller', SellerController::class);
    Route::resource('appointment', AppointmentController::class);
   
    Route::get('/home', [HomeController::class, 'index'])->name('home');
     Route::post('work/create-step-one', [WorkController::class,'postCreateStepOne'])->name('work.create.step.one.post');
    Route::get('work/create-step-two', [WorkController::class ,'createStepTwo'])->name('user.works.create2');
    Route::post('work/create-step-two', [WorkController::class ,'postCreateStepTwo'])->name('work.create.step.two.post');
    Route::post('/get-category', [DropdownController::class,'getCategory'])->name('get.category');
    Route::get('changeStatus', [ProductController::class ,'changeStatus']);
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::resource('offer', OfferController::class);
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('upStatus', [OfferController::class ,'upStatus']);
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
