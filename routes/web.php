<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\TrackersController;
use App\Http\Controllers\DatapointsController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;


require __DIR__ . '/auth.php';

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // profile managment
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // main routes
    Route::resource('trackers', TrackersController::class);
    Route::resource('datapoints', DatapointsController::class);
    // random routes
    Route::resource('posts', PostsController::class);
    Route::resource('images', ImagesController::class);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
});



// Forces HTTPS in production
if (App::environment('production')) {
    URL::forceScheme('https');
}
