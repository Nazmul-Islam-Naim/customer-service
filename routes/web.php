<?php

use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\DesignationController;
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
});

require __DIR__.'/auth.php';
