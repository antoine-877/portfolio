<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'author' => 'Antoine Mertens', // votre prénom et votre nom
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::get('projets', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projets/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::inertia('a-propos', 'About')->name('about');
Route::inertia('contact', 'Contact')->name('contact');


Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('projets', AdminProjectController::class)
            ->except('show')
            ->names('projects')
            ->parameters(['projets' => 'project']);
    });

require __DIR__ . '/settings.php';
