<?php

use App\Http\Controllers\UserWisataController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'checkUserType']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {



    Route::middleware(['auth', 'checkUserType:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('pages.dashboard');
        })->name('dashboard');
        Route::get('wisata', [WisataController::class, 'index'])->name('wisata');
        Route::get('wisata/{id}', [WisataController::class, 'show'])->name('show');
        Route::post('wisata/store', [WisataController::class, 'store'])->name('wisata.store');
        Route::get('wisata/{id}', [WisataController::class, 'edit'])->name('wisata.edit');
        Route::post('wisata/update', [WisataController::class, 'update'])->name('wisata.update');
        Route::get('wisata/destroy/{id}', [WisataController::class, 'destroy'])->name('wisata.destroy');
    });

    Route::middleware(['auth', 'checkUserType:user'])->group(function () {
        Route::get('/user/dashboard', function () {
            return view('pages.u_dashboard');
        })->name('user.dashboard');
    
        // Route::get('/user/wisata', function () {
        //     return view('pages.u_wisata');
        // })->name('user.wisata');

        Route::get('/user/wisata', [UserWisataController::class, 'index'])->name('user.wisata');
    
        Route::get('/user/trip', function () {
            return view('pages.u_trip');
        })->name('user.trip');
    });

});
