<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Route::get('/', HomeController::class);

Route::controller(ProductController::class)->group(function (){
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/card/{id}', 'show')->where(['id' => '[0-9]+'])->name('show');
    Route::post('/add-product', 'store')->name('store');
    Route::delete('/delete/{product}', 'destroy')->name('destroy');
    Route::get('/edit/{product}', 'edit')->name('edit-product');
    Route::put('/update/{product}', 'update')->name('update-product');
});

//Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

//Route::get('/card/{id}', [ProductController::class, 'show'])->where(['id' => '[0-9]+'])->name('show');

//Route::post('/add-product', [ProductController::class, 'store'])->name('store');

//Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('destroy');

//Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit-product');

//Route::put('/update/{product}', [ProductController::class, 'update'])->name('update-product');


Route::get('/dashboard/mod', function () {
    return view('product-card');
})->name('mod');

Auth::routes();
