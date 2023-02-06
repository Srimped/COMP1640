<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('admin.index');
});

//Route::get('createAcc',[UserController::class,'createAcc'])->name('createAcc');

Route::get('admin/login',function(){
    return view('admin.login');
})->name('admin.login');

Route::post('admin/login',[AdminController::class,'login']);

Route::middleware(['admin'])->group(function () {
    Route::get('admin/index',[AdminController::class,'index'])->name('admin.index');
});

Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
