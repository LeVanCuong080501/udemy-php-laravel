<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\MemberController;

use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;



// use App\Http\Controllers\HomeController as RootHomeController;

use Illuminate\Support\Facades\Route;

// ========================================= ADMIN ========================================= //
Route::get('/', function () {
    return view('welcome');
});



// Route::get('/home', [RootHomeController::class, 'index'])->name('home');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth'])->group(function () {
        // logout
        Route::post('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');

        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        // profile
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
    });
});


// ========================================= FRONTEND ========================================= //
Route::get('/index', [FrontendHomeController::class, 'home'])->name('home');

// Auth member
Route::prefix('member')->name('member.')->group(function () {
    // chưa login mới vào được
    Route::middleware('guest')->group(function () {
        Route::get('/login', [MemberController::class, 'login'])->name('login');
        Route::post('/login', [MemberController::class, 'postLogin'])->name('login.post');
        Route::get('/register', [MemberController::class, 'register'])->name('register');
        Route::post('/register', [MemberController::class, 'postRegister'])->name('register.post');
    });

    // phải login mới dùng được
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [MemberController::class, 'logout'])->name('logout');
    });
});

Auth::routes();