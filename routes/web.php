<?php

use App\Http\Controllers\Admin\InscricaoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [Home::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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

//Route::prefix('teste')->group(function () {
    Route::get('/teste', [InscricaoController::class, 'index'])->name('teste');

    Route::get('/create', [InscricaoController::class, 'createAdd'])->name('inscricao.create');
    Route::post('/store', [InscricaoController::class, 'store'])->name('inscricao.store');
    
    Route::delete('/destroy/{id}', [InscricaoController::class, 'destroy'])->name('inscricao.destroy');
    
    Route::get('/{id}', [InscricaoController::class, 'edit'])->name('inscricao.edit');
    Route::put('/update/{id}', [InscricaoController::class, 'update'])->name('inscricao.update');
//});


require __DIR__.'/auth.php';
