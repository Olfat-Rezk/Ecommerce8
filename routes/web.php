<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        //$users =User::all();
        $users =DB::table('users')->get();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});

Route::get('/category/all',[CategoryController::class,'index'])->name('all.category');
Route::post('/category/store',[CategoryController::class,'store'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
Route::post('/category/update/{id}',[CategoryController::class,'update']);
Route::get('/category/softDelete/{id}',[CategoryController::class,'softDelete']);
Route::get('category/restore/{id}',[CategoryController::class,'restore']);
Route::get('category/delete/{id}',[CategoryController::class,'forceDelete']);



// for brand
Route::get('/brand/all',[BrandController::class,'index'])->name('all.brand');
Route::post('/brand/store',[BrandController::class,'store'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'edit']);
Route::post('/brand/update/{id}',[BrandController::class,'update']);
Route::get('/brand/softDelete/{id}',[BrandController::class,'softDelete']);
Route::get('brand/restore/{id}',[BrandController::class,'restore']);
Route::get('brand/delete/{id}',[BrandController::class,'forceDelete']);

