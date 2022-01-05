<?php

use App\Http\Controllers\Participation\ParticipationController;
use Illuminate\Support\Facades\Route;


Route::prefix('participation')->middleware(['auth', 'verified'])->name('participation.')->group(function () {
    Route::redirect('/', '/participation/');
    Route::get('/', [ParticipationController::class, 'index'])->name('index');
    Route::get('/create', [ParticipationController::class, 'create'])->name('create');
    Route::post('/store', [ParticipationController::class, 'store'])->name('store');
    Route::get('/{participation}/show', [ParticipationController::class, 'show'])->name('show');
    Route::post('/{participation}/send', [ParticipationController::class, 'send'])->name('send');
    Route::get('/{participation}/pdf', [ParticipationController::class, 'createPDF'])->name('pdf');
});
