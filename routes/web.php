<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\PushNotificationController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/logout', function () {
    Auth::logout();  // This will log out the user
    return redirect('/login');  // Redirect to the login page
})->name('logout');


Route::get('/dashboard', [MenuController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/menus/search', [MenuController::class, 'search'])->name('menu.search');

// Add this route for editing a menu item
Route::get('/admin/edit_menu/{id}', [MenuController::class, 'edit'])->name('menu.edit')->middleware('auth');
Route::post('/admin/edit_menu/{id}', [MenuController::class, 'update'])->name('menu.update')->middleware('auth');


Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('about_us.edit')->middleware('auth');
Route::put('/about-us/update', [AboutUsController::class, 'update'])->name('about_us.update')->middleware('auth');


Route::get('/push-notifications', [PushNotificationController::class, 'index'])->name('push_notifications.index')->middleware('auth');
Route::get('/push-notifications/search', [PushNotificationController::class, 'search'])->name('push_notifications.search')->middleware('auth');
Route::post('/push-notifications', [PushNotificationController::class, 'store'])->name('push_notifications.store')->middleware('auth');
