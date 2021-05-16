<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [SearchController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::post('/searchTrain', [SearchController::class, 'searchTrain'])->middleware(['auth'])->name('search-train');

Route::post('/bookTrain', [SearchController::class, 'bookTrain'])->middleware(['auth'])->name('book-train');

Route::post('/saveBooking', [SearchController::class, 'saveBooking'])->middleware(['auth'])->name('save-booking');



require __DIR__.'/auth.php';
