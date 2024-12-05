<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//APIS criadas para o projeto
Route::get('/racas', function () {
    return response()->json([
        ['id' => 1, 'descricao' => 'Branca'],
        ['id' => 2, 'descricao' => 'Preta'],
        ['id' => 3, 'descricao' => 'Parda'],
        ['id' => 4, 'descricao' => 'Amarela'],
        ['id' => 5, 'descricao' => 'Indígena'],
    ]);
});

Route::get('/estados-civis', function () {
    return response()->json([
        ['id' => 1, 'descricao' => 'Solteiro(a)'],
        ['id' => 2, 'descricao' => 'Casado(a)'],
        ['id' => 3, 'descricao' => 'Divorciado(a)'],
        ['id' => 4, 'descricao' => 'Viúvo(a)'],
        ['id' => 5, 'descricao' => 'União Estável'],
    ]);
});

require __DIR__.'/auth.php';
