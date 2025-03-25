<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TrackShipmentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\AdminShipmentController;
use App\Http\Controllers\ConfigController;
use App\Services\StatsService;

// Function to get available languages
function getAvailableLanguages()
{
    $langPath = base_path('lang');
    if (!File::exists($langPath)) {
        $langPath = resource_path('lang');
    }

    $directories = File::directories($langPath);
    return array_map('basename', $directories);
}

// Get available languages
$availableLanguages = getAvailableLanguages();
$localePattern = implode('|', $availableLanguages);

// Redirection vers la locale par défaut (fr)
Route::get('/', function () {
    return Redirect::to('/fr');
});

// Routes avec préfixe de locale
Route::prefix('{locale}')
    ->where(['locale' => $localePattern])
    ->middleware(['setlocale', 'track.visitors'])
    ->group(function () {
        Route::get('/', function () {
            return view('guest.welcome');
        })->name('home');

        Route::get('/services', [ServiceController::class, 'allServices'])->name('services');
        Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
        Route::get('/quote', [ContactController::class, 'showQuoteForm'])->name('quote');
        Route::post('/track', [ShipmentController::class, 'search'])->name('shipment.search');
        Route::get('/track/{shipment}', [TrackShipmentController::class, 'track'])->name('shipment.track');
        Route::get('/terms', function () {
            return view('guest.terms');
        })->name('terms');
        Route::get('/privacy', function () {
            return view('guest.privacy');
        })->name('privacy');
        // Make sure your route is defined within the locale group
    });

// Routes authentifiées
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Add this route or modify the existing dashboard route
    // Modifier la route du dashboard
    Route::get('/dashboard', function () {
        $statsService = new App\Services\StatsService();

        $visitorStats = $statsService->getVisitorStats();
        $quoteStats = $statsService->getQuoteStats();
        $shipmentStats = $statsService->getShipmentStats();
        $contactStats = $statsService->getContactStats();

        $visitors = App\Models\Visitor::latest()->paginate(10);

        return view('dashboard', compact(
            'visitors',
            'visitorStats',
            'quoteStats',
            'shipmentStats',
            'contactStats'
        ));
    })->middleware(['auth:sanctum', 'verified'])->name('dashboard');

    // Routes administratives sous /dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/configs', [ConfigController::class, 'index'])->name('configs');
        Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
        Route::get('/quote-request', [QuoteRequestController::class, 'index'])->name('quote-request');
        Route::get('/all-shipments', [ShipmentController::class, 'index'])->name('all-shipments');
    });
}); // Added the missing semicolon here

// Add this route for payment methods management
Route::get('/dashboard/payment-methods', function () {
    return view('payment-methods');
})->middleware(['auth:sanctum', 'verified'])->name('payment-methods');