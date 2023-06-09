<?php

use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\BusinessCategoryController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\DesignationController;
use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\DivisionController;
use App\Http\Controllers\Web\FollowUpController;
use App\Http\Controllers\Web\HomeController;
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

// Route::get('/dashboard', function () {
//     return view('user-home');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
        Route::get('performance-graph',[UserController::class,'userPerformaceGraph'])->name('performance-graph');
        Route::get('performance-list',[UserController::class,'userPerformaceList'])->name('performance-list');
        Route::get('customer-location/{id}',[UserController::class,'customerLocation'])->name('customer-location');

        //ajax
        Route::post('get-district-by-division-id',[UserController::class, 'districtByDivision'])->name('get-district-by-division-id');
        Route::post('get-area-by-district-id',[UserController::class, 'areaByDistrict'])->name('get-area-by-district-id');
        Route::get('performance-chart',[UserController::class, 'performanceChart'])->name('performance-chart');
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
        Route::get('customer-map/{id}', [CustomerController::class,'customerMap'])->name('customer-map');
        Route::get('/map',function(){
            return view('map');
        });
        Route::get('daily-customer-report', [CustomerController::class,'dailyCustomerReport'])->name('daily-customer-report');

        //ajax
        Route::post('get-products-by-business-cateygory-id',[CustomerController::class,'productsByCategory'])->name('get-products-by-business-cateygory-id');

        // map
        Route::get('get-lat-long',[CustomerController::class,'getLatLong'])->name('get-lat-long');
        Route::get('get-today-lat-long',[CustomerController::class,'getTodayLatLong'])->name('get-today-lat-long');

    });

    //******** follow up part *******//
    Route::prefix(config('app.customer'))->group(function () {
        Route::get('client-areas', [FollowUpController::class,'index'])->name('client-areas');
        Route::get('clients/{id}', [FollowUpController::class,'client'])->name('clients');
        Route::get('follow-ups/{id}', [FollowUpController::class,'followUp'])->name('follow-ups');
        Route::post('follow-ups-store', [FollowUpController::class,'store'])->name('follow-ups-store');
        Route::get('follow-ups-report', [FollowUpController::class,'followUpReport'])->name('follow-ups-report');
    });

    //******** target part *******//
    Route::prefix(config('app.customer'))->group(function () {
        Route::resource('targets', TargetController::class);
    });

    //************ change password ***********/
    Route::get('settings', [SettingController::class, 'index']);
    Route::put('update-user-password/{id}', [SettingController::class, 'updateUserPassword'])->name('update-user-password');
});

require __DIR__.'/auth.php';

//Clear Cache facade value:
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
    return '<h1>Storage Created</h1>';
});