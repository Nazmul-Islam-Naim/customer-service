<?php

use App\Http\Controllers\Web\BusinessCategoryController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\DesignationController;
use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\DivisionController;
use App\Http\Controllers\Web\FollowUpController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\TargetController;
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

    
    //******** area part *******//
    Route::prefix(config('app.area'))->group(function () {
        Route::resource('division', DivisionController::class);
        Route::resource('district', DistrictController::class);
        Route::resource('area', AreaController::class);
    });

    //******** users part *******//
    Route::prefix(config('app.user'))->group(function () {
        Route::resource('department', DepartmentController::class);
        Route::resource('designation', DesignationController::class);
        Route::resource('user-list', UserController::class);
        Route::resource('user-role', RoleController::class);

        //ajax
        Route::post('get-district-by-division-id',[UserController::class, 'districtByDivision'])->name('get-district-by-division-id');
        Route::post('get-area-by-district-id',[UserController::class, 'areaByDistrict'])->name('get-area-by-district-id');
    });

    //******** business and product part *******//
    Route::prefix(config('app.business'))->group(function () {
        Route::resource('business-category', BusinessCategoryController::class);
        Route::resource('products',ProductController::class);

        //ajax
        Route::get('ajax-business-category',[ProductController::class,'businessCategory'])->name('ajax-business-category');
    });
    
    //******** customers part *******//
    Route::prefix(config('app.customer'))->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::get('/map',function(){
            return view('map');
        });

        //ajax
        Route::post('get-products-by-business-cateygory-id',[CustomerController::class,'productsByCategory'])->name('get-products-by-business-cateygory-id');
        Route::get('get-lat-long',[CustomerController::class,'getLatLong'])->name('get-lat-long');
    });

    //******** follow up part *******//
    Route::prefix(config('app.customer'))->group(function () {
        Route::resource('follow-ups', FollowUpController::class);
        Route::get('/follow-up-map',function(){
            return 'under construction';
        });
    });

    //******** target part *******//
    Route::prefix(config('app.customer'))->group(function () {
        Route::resource('targets', TargetController::class);
    });

});

require __DIR__.'/auth.php';
