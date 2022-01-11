<?php

use App\Http\Controllers\Participation\ParticipationController;
use Illuminate\Support\Facades\Route;


Route::prefix('participation')->middleware(['auth', 'verified'])->name('participation.')->group(function () {
    Route::get('/', [ParticipationController::class, 'index'])->name('index');
    Route::get('/create', [ParticipationController::class, 'create'])->name('create');
    Route::post('/store', [ParticipationController::class, 'store'])->name('store');
    Route::get('/{participation}/show', [ParticipationController::class, 'show'])->name('show');
    Route::get('/{participation}/edit', [ParticipationController::class, 'edit'])->name('edit');
    Route::post('/{participation}/update', [ParticipationController::class, 'update'])->name('update');
    Route::get('/{participation}/pdf', [ParticipationController::class, 'createPDF'])->name('pdf');

    Route::get('/{participation}/print/{secret}', [ParticipationController::class, 'print'])
        ->withoutMiddleware(['auth', 'verified'])
        ->middleware('secret')
        ->name('print');
});
