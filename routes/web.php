<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('Album', AlbumController::class)->middleware('auth')->names('album');
// Route::post('albums/{album}/upload', [AlbumController::class,'upload'])->middleware('auth')->name('album.upload');
// Route::get('albums/{album}/image/{image}', [AlbumController::class,'showImage'])->middleware('auth')->name('album.image.show');
// Route::get('albums/{album}/image/{image}', [AlbumController::class,'destroyImage'])->middleware('auth')->name('album.image.destory');
Route::post('albums/{album}/upload', [AlbumController::class, 'upload'])->name('ablums.upload')->middleware('auth');
Route::get('/albums/{album}/image/{image}', [AlbumController::class, 'showImage'])->name('album.image.show');
Route::delete('/albums/{album}/image/{image}', [AlbumController::class, 'destroyImage'])->name('album.image.destroy');

require __DIR__.'/auth.php';
