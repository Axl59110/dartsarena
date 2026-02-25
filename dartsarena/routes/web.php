<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FederationController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ArticleController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Localized Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    // Homepage
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Articles / News
    Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/news/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

    // Federations
    Route::get('/federations', [FederationController::class, 'index'])->name('federations.index');
    Route::get('/federations/{federation:slug}', [FederationController::class, 'show'])->name('federations.show');

    // Competitions
    Route::get('/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
    Route::get('/competitions/{competition:slug}', [CompetitionController::class, 'show'])->name('competitions.show');

    // Players
    Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/players/{player:slug}', [PlayerController::class, 'show'])->name('players.show');

    // Rankings
    Route::get('/rankings', [RankingController::class, 'index'])->name('rankings.index');

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // Guides
    Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
    Route::get('/guides/{guide:slug}', [GuideController::class, 'show'])->name('guides.show');

});

// Redirect root to default locale
Route::get('/', function () {
    return redirect(LaravelLocalization::getLocalizedURL(config('app.locale'), '/'));
});
