<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;

// Login formu (GET)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Login əməliyyatı (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin üçün route-lar
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // İstifadəçilər səhifəsi
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');

    // İstifadəçi redaktə
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    // İstifadəçi sil
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/admin/polls/create', [AdminController::class, 'createPoll'])->name('admin.polls.create');
    Route::post('/admin/polls/store', [AdminController::class, 'storePoll'])->name('admin.polls.store');

    // Səsvermə redaktə
    Route::get('/admin/polls/{poll}/edit', [AdminController::class, 'editPoll'])->name('admin.polls.edit');
    Route::put('/admin/polls/{poll}', [AdminController::class, 'updatePoll'])->name('admin.polls.update');

    // Səsvermə sil
    Route::delete('/admin/polls/{poll}', [AdminController::class, 'deletePoll'])->name('admin.polls.delete');

    // Səsvermə siyahısı
    Route::get('/admin/polls', [AdminController::class, 'polls'])->name('admin.polls');

    // Səsvermə idarəetmə route-ları
    Route::get('/admin/polls', [PollController::class, 'index'])->name('admin.polls');
    Route::post('/admin/polls', [PollController::class, 'store'])->name('admin.polls.store');

    Route::get('/admin/poll-results/{id}', [AdminController::class, 'pollResults'])->name(name: 'admin.poll.results');


});

// User üçün route-lar
Route::middleware(['auth', 'is_user'])->group(function () {

    // User dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // User səsvermə əməliyyatı
    Route::post('/user/polls/vote', [UserController::class, 'vote'])->name('user.polls.vote');
});




