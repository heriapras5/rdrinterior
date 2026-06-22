<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\SlideController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori', [CategoryController::class, 'index'])->name('categories');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('category.products');
Route::get('/produk', [ShopController::class, 'index'])->name('products');
Route::get('/produk/{slug}', [ShopController::class, 'show'])->name('product.detail');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.detail');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin', [LoginController::class, 'login']);
    Route::get('/admin/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/admin/register', [RegisterController::class, 'register']);
});

Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/product-categories', ProductCategoryController::class)
        ->parameters(['product-categories' => 'productCategory']);
    Route::resource('/blog-categories', BlogCategoryController::class)
        ->parameters(['blog-categories' => 'blogCategory']);
    Route::resource('/products', ProductController::class);
    Route::resource('/blogs', AdminBlogController::class);
    Route::resource('/messages', ContactMessageController::class)
        ->only(['index', 'show', 'destroy']);

    Route::resource('/admins', \App\Http\Controllers\Admin\AdminController::class)
        ->parameters(['admins' => 'admin']);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/about-settings', [AboutSettingController::class, 'edit'])->name('about-settings.edit');
    Route::post('/about-settings', [AboutSettingController::class, 'update'])->name('about-settings.update');

    Route::resource('/slides', SlideController::class);
});
