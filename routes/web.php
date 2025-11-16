<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Collections
Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection:slug}', [CollectionController::class, 'show'])->name('collections.show');
Route::get('/collections/{collection:slug}/book/{book:slug}', [BookController::class, 'show'])->name('books.show');
Route::get('/collections/{collection:slug}/book/{book:slug}/chapter/{chapter:slug}', [ChapterController::class, 'show'])->name('chapters.show');

// Hadith
Route::get('/hadith/{hadith}', [HadithController::class, 'show'])->name('hadith.show');

// Scholars
Route::get('/scholars', [ScholarController::class, 'index'])->name('scholars.index');
Route::get('/scholars/{scholar:slug}', [ScholarController::class, 'show'])->name('scholars.show');

// Topics
Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
Route::get('/topics/{topic:slug}', [TopicController::class, 'show'])->name('topics.show');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// SEO (must come before catch-all page route)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

// Pages (catch-all route - must be last)
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');

// Auth Routes
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
