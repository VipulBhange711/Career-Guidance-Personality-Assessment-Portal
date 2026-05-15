<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::redirect('/index.html', '/');
Route::redirect('/login.html', '/login');
Route::redirect('/register.html', '/register');
Route::redirect('/dashboard.html', '/dashboard');
Route::redirect('/assessment.html', '/assessment');
Route::redirect('/careers.html', '/careers');
Route::redirect('/profile.html', '/profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment.index');
    Route::get('/assessment/{assessment}', [AssessmentController::class, 'show'])->name('assessment.show');
    Route::post('/assessment/{assessment}/submit', [AssessmentController::class, 'submit'])->name('assessment.submit');
    Route::get('/results/{attempt}', [AssessmentController::class, 'results'])->name('results.show');
    Route::get('/results.html', fn () => redirect()->route('dashboard'));
    Route::post('/careers/{career}/save', [CareerController::class, 'save'])->name('careers.save');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/dashboard.html', '/admin/dashboard');
});

require __DIR__.'/auth.php';
