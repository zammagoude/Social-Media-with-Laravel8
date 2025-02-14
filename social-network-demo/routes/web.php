<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\FriendController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PostController;




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
Route::middleware(['guest'])->get('/',[WelcomeController::class, 'show'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->prefix('user')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('profile/{user:username}', [ProfileController::class, 'show'])->name('profiles.show');

    Route::get('members', [MemberController::class, 'index'])->name('members.index');

    // Route::prefix('posts')->name('posts.')->group(function(){
    //         Route::post('', [PostController::class, 'store'])->name('store');
            
    // });
    Route::prefix('posts')->name('posts.')->group(function() {
        Route::post('', [PostController::class, 'store'])->name('store');
        // Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('friends')->name('friends.')->group(function(){
        Route::post('/{user}', [FriendController::class, 'store'])->name('store');
        Route::patch('/{user}', [FriendController::class, 'update'])->name('update');
        Route::get('/{user}', [FriendController::class, 'deny'])->name('deny');
        Route::delete('/{user}', [FriendController::class, 'destroy'])->name('destroy');
    });

});