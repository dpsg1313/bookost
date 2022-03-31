<?php

use App\Http\Controllers\Participation\ListController;
use App\Http\Controllers\Participation\ParticipationController;
use Illuminate\Support\Facades\Route;


Route::prefix('participation')->middleware(['auth', 'verified'])->name('participation.')->group(function () {
    Route::get('/', [ParticipationController::class, 'index'])->name('index');
    Route::get('/create/{mode?}', [ParticipationController::class, 'create'])->name('create');
    Route::post('/store', [ParticipationController::class, 'store'])->name('store');
    Route::post('/apply', [ParticipationController::class, 'storeAndApply'])->name('store-and-apply');
    Route::get('/{participation}/show', [ParticipationController::class, 'show'])->name('show');
    Route::get('/{participation}/edit', [ParticipationController::class, 'edit'])->name('edit');
    Route::post('/{participation}/update', [ParticipationController::class, 'update'])->name('update');
    Route::post('/{participation}/apply', [ParticipationController::class, 'updateAndApply'])->name('update-and-apply');
    Route::get('/{participation}/pdf', [ParticipationController::class, 'createPDF'])->name('pdf');
    Route::get('/{participation}/preview', [ParticipationController::class, 'print'])->name('preview');

    Route::get('/{participation}/print/{secret}', [ParticipationController::class, 'print'])
        ->withoutMiddleware(['auth', 'verified'])
        ->middleware('secret')
        ->name('print');

    Route::get('/list', [ListController::class, 'listParticipations'])->name('list');
    Route::get('/{participation}/sign', [ListController::class, 'signParticipation'])->name('sign');
    Route::get('/{participation}/pay', [ListController::class, 'payParticipation'])->name('pay');
    Route::get('/export', [ListController::class, 'exportParticipations'])->name('export');
});

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {

});
