<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// user
Route::get('/profile', [UserController::class, 'user'])->name('profile');
Route::post('/profile/update', [UserController::class, 'update'])->name('update');

// country
Route::get('/country', [CountryController::class, 'index'])->name('country.index');
Route::get('/country/add', [CountryController::class, 'add'])->name('country.add');
Route::post('/country/list', [CountryController::class, 'list'])->name('country.list');
Route::get('/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');

// blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/add', [BlogController::class, 'add'])->name('blog.add');
Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::get('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
