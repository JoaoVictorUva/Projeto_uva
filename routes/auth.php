<?php

use App\Http\Controllers\Admin\CandidatoController;

use App\Http\Controllers\Admin\InscricaoController;
use App\Http\Controllers\Admin\SelecaoController;
use App\Http\Controllers\Admin\VagaController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {

    

    Route::prefix('candidatos')->group(function () {

        Route::get('/', [CandidatoController::class, 'index'])->name('candidato');

        Route::get('/create', [CandidatoController::class, 'createAdd'])->name('candidato.create');
        Route::post('/store', [CandidatoController::class, 'store'])->name('candidato.store');

        Route::delete('/destroy/{id}', [CandidatoController::class, 'destroy'])->name('candidato.destroy');

        Route::get('/{id}', [CandidatoController::class, 'edit'])->name('candidato.edit');
        Route::put('/update/{id}', [CandidatoController::class, 'update'])->name('candidato.update');
    });

    Route::prefix('selecoes')->group(function () {
        Route::get('/', [SelecaoController::class, 'index'])->name('selecao');
        
        Route::get('/create', [SelecaoController::class, 'createAdd'])->name('selecao.create');
        Route::post('/store', [SelecaoController::class, 'store'])->name('selecao.store');
        
        Route::delete('/destroy/{id}', [SelecaoController::class, 'destroy'])->name('selecao.destroy');
        Route::get('/{id}', [SelecaoController::class, 'edit'])->name('selecao.edit');
        Route::put('/update/{id}', [SelecaoController::class, 'update'])->name('selecao.update');
    });
    
    Route::prefix('vagas')->group(function () {
        Route::get('/', [VagaController::class, 'index'])->name('vaga');

        Route::get('/create', [VagaController::class, 'createAdd'])->name('vaga.create');
        Route::post('/store', [VagaController::class, 'store'])->name('vaga.store');
        
        Route::delete('/destroy/{id}', [VagaController::class, 'destroy'])->name('vaga.destroy');
        
        Route::get('/{id}', [VagaController::class, 'edit'])->name('vaga.edit');
        Route::put('/update/{id}', [VagaController::class, 'update'])->name('vaga.update');
    });

    Route::prefix('inscricoes')->group(function () {
        Route::get('/', [InscricaoController::class, 'index'])->name('inscricao');

        Route::get('/create', [InscricaoController::class, 'createAdd'])->name('inscricao.create');
        Route::post('/store', [InscricaoController::class, 'store'])->name('inscricao.store');
        
        Route::delete('/destroy/{id}', [InscricaoController::class, 'destroy'])->name('inscricao.destroy');
        
        Route::get('/{id}', [InscricaoController::class, 'edit'])->name('inscricao.edit');
        Route::put('/update/{id}', [InscricaoController::class, 'update'])->name('inscricao.update');
    });

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
