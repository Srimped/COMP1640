<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Carbon;

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
    return view('Goodi.index');
});

Route::get('/login', function () {
    return view('Goodi.login');
})->name('admin.login');

Route::post('admin/login', [AdminController::class, 'login']);

Route::middleware(['admin'])->group(function () {
    Route::get('admin/index', function () {
        return view('Goodi/admin/index');
    })->name('admin.index');
    Route::get('admin/acc', [AdminController::class, 'acc'])->name('admin.acc');
    Route::get('admin/createAcc', function () {
        return view('Goodi/admin/createAcc');
    });
    Route::post('admin/createAcc', [AdminController::class, 'createAcc']);
    Route::get("admin/showAcc/{id}", [AdminController::class, 'showAcc']);
    Route::get("admin/editAcc/{id}", [AdminController::class, 'editAcc']);
    Route::post("admin/editAcc/{id}", [AdminController::class, 'updateAcc']);
    Route::get("admin/deleteAcc/{id}", [AdminController::class, 'deleteAcc']);
    Route::post("admin/deleteAcc/{id}", [AdminController::class, 'delete']);
});


Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
