<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [RealEstateController::class, 'index'])->name('home');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');


    Route::get('/real-estates/create', [RealEstateController::class, 'create'])->name('real-estates.create');
    Route::post('/real-estates', [RealEstateController::class, 'store'])->name('real-estates.store');

    Route::get('/real-estates/{realEstate}/edit', [RealEstateController::class, 'edit'])->name('real-estates.edit');
    Route::put('/real-estates/{realEstate}', [RealEstateController::class, 'update'])->name('real-estates.update');
    Route::delete('/real-estates/{realEstate}', [RealEstateController::class, 'destroy'])->name('real-estates.destroy');

});

Route::get('/real-estates', [RealEstateController::class, 'index'])->name('real-estates.index');


require __DIR__.'/auth.php';
