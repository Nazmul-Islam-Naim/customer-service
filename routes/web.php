<?php

use App\Http\Controllers\Web\BusinessCategoryController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\DesignationController;
use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\DivisionController;
use App\Http\Controllers\Web\ProductCategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('user-home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    //******** users part *******//
    Route::prefix(config('app.user'))->group(function () {
        Route::resource('department', DepartmentController::class);
        Route::resource('designation', DesignationController::class);
        Route::resource('user-list', UserController::class);
        Route::resource('user-role', RoleController::class);
    });

    //******** users part *******//
    Route::prefix(config('app.area'))->group(function () {
        Route::resource('division', DivisionController::class);
        Route::resource('district', DistrictController::class);
        Route::resource('area', AreaController::class);
    });

    //******** customers part *******//
    Route::prefix(config('app.customer'))->group(function () {
        Route::resource('business-category', BusinessCategoryController::class);
        Route::resource('customers', CustomerController::class);
    });

    //******** product part *******//
    Route::prefix(config('app.product'))->group(function () {
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('products',ProductController::class);

        //ajax
        Route::get('ajax-product-category',[ProductController::class,'productCategory'])->name('ajax-product-category');
    });

});

require __DIR__.'/auth.php';
