<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConsentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

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


/* Public Pages */
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

/* Consent Routes */
Route::post('/consent/accept', [ConsentController::class, 'accept'])->name('consent.accept');
Route::post('/consent/decline', [ConsentController::class, 'decline'])->name('consent.decline');


/* Admin Routes (Auth Middleware) */
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/consents', [AdminController::class, 'consents'])->name('admin.consents');
});
