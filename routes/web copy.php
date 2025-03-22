<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShipmentController;

// Redirection vers la locale par défaut (fr)
Route::get('/', function () {
    return Redirect::to('/fr');
});

// Routes avec préfixe de locale
Route::prefix('{locale}')
    ->where(['locale' => 'fr|en|es']) // Ajoutez 'es' ici
    ->middleware('setlocale') // Appliquer le middleware SetLocale
    ->group(function () {

        // Page d'accueil
        Route::get('/', function () {
            return view('guest.welcome');
        })->name('home');

        // Page des services
        Route::get('/services', [ServiceController::class, 'allServices'])->name('services');

        // Page de contact
        Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');

        // Page de demande de devis
        Route::get('/quote', [ContactController::class, 'showQuoteForm'])->name('quote');

        // Page des conditions d'utilisation
        Route::get('/terms', function () {
            return view('guest.terms');
        })->name('terms');

        // Page de politique de confidentialité
        Route::get('/privacy', function () {
            return view('guest.privacy');
        })->name('privacy');

        // Suivi de colis
        Route::get('/track/{shipment}', [ShipmentController::class, 'track'])->name('shipment.track');
    });

// Routes Breeze avec Livewire (authentification)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); // Tableau de bord protégé
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile'); // Profil utilisateur protégé

// Fichier d'authentification Breeze
require __DIR__.'/auth.php';