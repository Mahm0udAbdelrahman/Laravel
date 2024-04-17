<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dash\UserController;

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
    return view('front.index');
})->name('main');

// Route::get('/dashboard/index', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified' , 'dashAccess'])->name('dashboard');


Route::middleware(['auth', 'verified' , 'dashAccess'])->as('dash.')->prefix('dash')->group(function(){
    Route::get('/index', function () {
        return view('dashboard.index');
    })->name('main');

    Route::resources([
        'users' => UserController::class,
    ]);


});

Route::get('/edit', function () {
    return view('dashboard.users.edit');
})->name('main');




Route::middleware('auth')->as('profile.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
