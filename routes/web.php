<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\MentorController;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/programs', [WebsiteController::class, 'programsIndex'])->name('programs.index');
Route::get('/programs/{program}', [WebsiteController::class, 'programShow'])->name('programs.show');
Route::get('/about-us', [WebsiteController::class, 'about'])->name('about');
Route::get('/mentors', [WebsiteController::class, 'mentorsIndex'])->name('mentors.index');
Route::get('/success-stories', [WebsiteController::class, 'successStories'])->name('success-stories');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');

// --- ROUTE KHUSUS PENDAFTARAN KURSUS (UNTUK USER BIASA) ---
Route::get('/daftar-kursus', [WebsiteController::class, 'registration'])->name('kursus.daftar');
Route::post('/daftar-kursus', [RegistrationController::class, 'store'])->name('kursus.simpan');


// --- ROUTE UNTUK ADMIN (HANYA BISA DIAKSES SAAT LOGIN) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard')->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Pendaftar (Lihat siapa yang daftar & Hapus)
    Route::resource('/registrations', AdminRegistrationController::class)->only(['index', 'destroy']);
    
    // CRUD Program & Mentor
    Route::resource('/programs', ProgramController::class)->except(['show']);
    Route::resource('/mentors', MentorController::class)->except(['show']);
});

// Route Login & Register Admin (Breeze)
require __DIR__.'/auth.php';
