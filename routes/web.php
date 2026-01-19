<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('patients', PatientController::class);

    Route::prefix('patients/{patient}/records')->name('patients.records.')->group(function () {
        Route::get('create', [RecordController::class, 'create'])->name('create');
        Route::post('', [RecordController::class, 'store'])->name('store');
    });

    Route::prefix('records')->name('records.')->group(function () {
        Route::get('{record}/edit', [RecordController::class, 'edit'])->name('edit');
        Route::put('{record}', [RecordController::class, 'update'])->name('update');
        Route::delete('{record}', [RecordController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('attachments')->name('attachments.')->group(function () {
        Route::get('{attachment}', [AttachmentController::class, 'download'])->name('download');
        Route::delete('{attachment}', [AttachmentController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/settings.php';
