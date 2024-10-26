<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Participation\ListController;
use App\Http\Controllers\Participation\ParticipationController;
use App\Http\Controllers\Participation\StatisticController;
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

    Route::get('/bulksign', [ListController::class, 'bulkSignParticipations'])->name('bulksign');
    Route::post('/bulksign', [ListController::class, 'saveSignatures'])->name('saveSignatures');

    Route::get('/bulkpay', [ListController::class, 'bulkPayParticipations'])->name('bulkpay');
    Route::post('/bulkpay', [ListController::class, 'savePayments'])->name('savePayments');

    Route::get('/{participation}/correct', [ListController::class, 'correctParticipation'])->name('correct');
    Route::post('/{participation}/correct', [ListController::class, 'saveCorrection'])->name('saveCorrection');

    Route::get('/statistics', [StatisticController::class, 'showStats'])->name('statistics');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'adminOnly'])->name('admin.')->group(function () {
    Route::get('/user/list', [AdminController::class, 'listUsers'])->name('user.list');
    Route::post('/user/{user}/responsibility', [AdminController::class, 'saveUserResponsibility'])->name('user.responsibility');

    Route::get('/participation/manual', [AdminController::class, 'manual'])->name('participation.manual');
    Route::post('/participation/append', [AdminController::class, 'append'])->name('participation.append');
});
