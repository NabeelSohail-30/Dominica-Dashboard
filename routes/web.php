<?php

use App\Http\Controllers\DetailsController;
use App\Http\Controllers\HikeDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\AchivementController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FeaturedLocation;
use App\Http\Controllers\ListingController;

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

Route::get('/menus/listing/{id}', [ListingController::class, 'index'])->name('listing')->middleware('auth');
Route::get('/listing/create/{id}', [ListingController::class, 'create'])->name('listing.create')->middleware('auth');
Route::post('/menus/listing/store/{id}', [ListingController::class, 'store'])->name('listing.store')->middleware('auth');
Route::get('/menus/listing/edit/{id}', [ListingController::class, 'edit'])->name('listing.edit')->middleware('auth');
Route::put('/menus/listing/update/{id}', [ListingController::class, 'update'])->name('listing.update')->middleware('auth');
Route::put('/menus/listing/deactivate/{id}', [ListingController::class, 'deactivate'])->name('listing.deactivate')->middleware('auth');

Route::get('/weather/edit', [MenuController::class, 'edit_weather'])->name('weather.edit_weather')->middleware('auth');
Route::post('/weather/update', [MenuController::class, 'update_weather'])->name('weather.update_weather')->middleware('auth');

Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('about_us.edit')->middleware('auth');
Route::put('/about-us/update', [AboutUsController::class, 'update'])->name('about_us.update')->middleware('auth');

Route::get('/push-notifications', [PushNotificationController::class, 'index'])->name('push_notifications.index')->middleware('auth');
Route::get('/push-notifications/search', [PushNotificationController::class, 'search'])->name('push_notifications.search')->middleware('auth');
Route::post('/push-notifications', [PushNotificationController::class, 'store'])->name('push_notifications.store')->middleware('auth');

Route::get('/achievements', [AchivementController::class, 'index'])->name('achievements.index')->middleware('auth');
Route::get('/achievements/search', [AchivementController::class, 'search'])->name('achievements.search')->middleware('auth');
Route::get('/achievements/create', [AchivementController::class, 'create'])->name('achievements.create')->middleware('auth');
Route::post('/achievements/store', [AchivementController::class, 'store'])->name('achievements.store')->middleware('auth');
Route::delete('/achievements/{id}', [AchivementController::class, 'destroy'])->name('achievements.destroy')->middleware('auth');
Route::get('/achievements/{id}/edit', [AchivementController::class, 'edit'])->name('achievements.edit')->middleware('auth');
Route::put('/achievements/{id}', [AchivementController::class, 'update'])->name('achievements.update')->middleware('auth');

Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index')->middleware('auth');
Route::get('/ratings/search', [RatingController::class, 'search'])->name('ratings.search')->middleware('auth');

Route::get('/featured_location', [FeaturedLocation::class, 'index'])->name('featured_location.index')->middleware('auth');
Route::get('/featured_location/create', [FeaturedLocation::class, 'create'])->name('featured_location.create')->middleware('auth');
Route::post('/featured_location/store', [FeaturedLocation::class, 'store'])->name('featured_location.store')->middleware('auth');
Route::delete('/featured_location/delete/{id}', [FeaturedLocation::class, 'destroy'])->name('featured_location.destroy')->middleware('auth');

Route::get('/hike', [HikeDetailsController::class, 'index'])->name('hike.index')->middleware('auth');
Route::get('/hike/detail/{id}', [HikeDetailsController::class, 'detail'])->name('hike.detail')->middleware('auth');

Route::get('details/{id}', [DetailsController::class, 'index'])->name('details.index')->middleware('auth');
Route::get('details/create', [DetailsController::class, 'create'])->name('details.create')->middleware('auth');
