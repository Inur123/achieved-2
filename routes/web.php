<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
//auth
Route::middleware('auth')->group(function () {
    Route::get('user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


});

Route::prefix('admin')->middleware('auth')->group(function () {
  // Authors Routes
  Route::get('/authors', [AuthorController::class, 'index'])->name('blog.authors.index');
  Route::get('/authors/create', [AuthorController::class, 'create'])->name('blog.authors.create');
  Route::post('/authors', [AuthorController::class, 'store'])->name('blog.authors.store');
  Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('blog.authors.edit');
  Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('blog.authors.update');
  Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('blog.authors.destroy');

    // Categories Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('blog.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('blog.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('blog.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('blog.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('blog.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('blog.categories.destroy');

    // Posts Routes
    Route::get('/posts', [PostController::class, 'index'])->name('blog.posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('blog.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('blog.posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('blog.posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('blog.posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('blog.posts.destroy');
    // Tags Routes
    Route::post('/tags', [TagController::class, 'store'])->name('blog.tags.store');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('blog.tags.destroy');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('blog.tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('blog.tags.update');
    Route::get('/tags/create', [TagController::class, 'create'])->name('blog.tags.create');
    Route::get('/tags', [TagController::class, 'index'])->name('blog.tags.index');

    //products
    Route::resource('products', ProductController::class);




});



//laravel-socialite
Route::get('/auth/redirect',[SocialiteController::class,'redirect']);

Route::get('/auth/google/callback',[SocialiteController::class,'callback']);


