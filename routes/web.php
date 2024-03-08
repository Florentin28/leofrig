<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will be assigned to the "web" middleware group.
| Make something great!
|
*/

// Redirection vers la page de connexion lorsque la racine est accédée
Route::redirect('/', '/login');

// Route vers la page de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route vers la page principale après la connexion
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route vers la page admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');



// Route vers le tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour le profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include les routes d'authentification
require __DIR__.'/auth.php';
