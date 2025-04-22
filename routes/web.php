<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // プロフィール管理
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRM機能
    Route::resource('companies', CompanyController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('deals', DealController::class);
    Route::resource('activities', ActivityController::class);

    // API
    Route::get('/api/companies/{company}/contacts', function (App\Models\Company $company) {
        return $company->contacts()->select('id', 'first_name', 'last_name')
            ->orderBy('last_name')
            ->get()
            ->map(function ($contact) {
                return [
                    'id' => $contact->id,
                    'full_name' => $contact->full_name
                ];
            });
    });

    Route::get('/api/companies/{company}/deals', function (App\Models\Company $company) {
        return $company->deals()->select('id', 'title')
            ->orderBy('title')
            ->get();
    });
});

require __DIR__.'/auth.php';
