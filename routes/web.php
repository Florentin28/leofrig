<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReleveController; 
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ConsultationController;

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

// Routes pour la partie Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/succursale/{id}', [AdminController::class, 'showSuccursale'])->name('admin.show');
    // Permettre aux administrateurs d'accéder à la page d'accueil
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Routes pour la partie Consultation
Route::middleware(['auth', 'role:consultation'])->group(function () {
    Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::get('/consultation/{succursale}', [ConsultationController::class, 'show'])->name('consultation.show');
});

// Routes pour la partie Utilisateur (User)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

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

// Route pour l'ajout de données dans la base de données
Route::get('/nouveau-releve', [ReleveController::class, 'create'])->name('nouveau_releve');
Route::post('/releves', [ReleveController::class, 'store'])->name('releves.store');

Route::get('/verifier-releves', [VerificationController::class, 'index'])->name('verifier-releves');
Route::delete('/releves/{releve}', [ReleveController::class, 'destroy'])->name('releves.destroy');

Route::get('/releves-effectues', [ReleveController::class, 'relevesEffectues'])->name('releves_effectues');

Route::get('/emplacements-a-relever', [ReleveController::class, 'emplacementsARelever'])->name('emplacements_a_relever');

// Include les routes d'authentification
require __DIR__.'/auth.php';
