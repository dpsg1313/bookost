<?php

use App\Http\Controllers\Participation\ParticipationController;
use Illuminate\Support\Facades\Route;


Route::prefix('participation')->middleware(['auth', 'verified'])->name('participation.')->group(function () {
    Route::redirect('/', '/participation/list');
    Route::get('/list', [ParticipationController::class, 'list'])->name('list');
    Route::get('/create', [ParticipationController::class, 'create'])->name('create');
    Route::post('/store', [ParticipationController::class, 'store'])->name('store');
    Route::get('/finish', [ParticipationController::class, 'finish'])->name('finish');
    Route::post('/send', [ParticipationController::class, 'send'])->name('send');
    Route::get('/print', [ParticipationController::class, 'print'])->name('print');
});
