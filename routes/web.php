<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Services\product\UploadService;

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

Route::get('/', [LoginController::class, 'index'])->name('login'); // name là login để khi middeware auth xảy ra
// thì nó sẽ gọi tới login
Route::post('admin/users/home', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('/users/main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::get('list', [MenuController::class, 'index'])->name('list');
            Route::post('add', [MenuController::class, 'store'])->name('addCategory');
            Route::delete('delete', [MenuController::class, 'destroy']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store'])->name('addProduct');
            Route::get('list', [ProductController::class, 'index']);
            Route::delete('delete', [ProductController::class, 'destroy']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::get('editActive/{product}', [ProductController::class, 'editAcitve']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});
