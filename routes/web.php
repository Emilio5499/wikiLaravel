<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('contacto', 'contact')->name('contact');

Route::get('blog/myposts', [PostController::class, 'userPosts'])
     ->name('blog.myposts');
Route::resource('blog', PostController::class)
    ->names('posts')
    ->parameters(['blog' => 'post']);

Route::view('nosotros', 'about')->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::middleware(['auth', 'can:moderate,App\Models\Post'])->group(function () {
    Route::get('/posts/pending', [PostController::class, 'pending'])->name('posts.pending');
    Route::post('/posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
    Route::post('/posts/{id}/reject', [PostController::class, 'reject'])->name('posts.reject');
});

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{id}/pdf', [PostController::class, 'descargarPDF'])->name('posts.pdf');

require __DIR__.'/auth.php';
