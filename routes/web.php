<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FEControllers;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionsInController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

//dashboard
Route::get('/',[FEControllers::class,'index'])->name("home")->middleware("auth");

//transaction new
Route::post('/newtransactionadd',[TransactionController::class,'save'])->middleware("auth");
Route::get('/newtransactionmin/{id}',[TransactionController::class,'delete'])->middleware("auth");
Route::get('/newtransactionremove/{id}',[TransactionController::class,'destroy'])->middleware("auth");
Route::get('/newtransactionaccept/{id}',[TransactionController::class,'accept'])->middleware("auth");
Route::resource("/newtransaction",TransactionController::class,[
    "as"=>"prefix"
])->middleware("auth");

//transaction
Route::get('/transaction',[TransactionController::class,'get'])->name('trxget')->middleware('auth');
Route::get('/transaction_detail/{id}',[TransactionController::class,'getDetail'])->name('trxdetail')->middleware('auth');

//product
Route::resource("/product",ProductController::class,[
    "as"=>"prefix"
])->middleware("auth");

//outlet
Route::resource("/outlet",OutletController::class,[
    "as"=>"prefix"
])->middleware("auth");

//supplier
Route::resource("/supplier",SupplierController::class,[
    "as"=>"prefix"
])->middleware("auth");

//ck editor
Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');

//auth
Auth::routes();

//transaction_in
Route::resource("/transmasuk",TransactionsInController::class,[
    "as"=>"prefix"
])->middleware("auth");

//category
Route::resource("/category",CategoryController::class,[
    "as"=>"prefix"
])->middleware("auth");

//laporan
Route::resource("/laporan",LaporanController::class,[
    "as"=>"prefix"
])->middleware("auth");

Route::get("/cetakproduk/{id}",[LaporanController::class,"cetak"])->name('cetakproduk')->middleware("auth");

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//logout
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/login');
 })->name('logout');