<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id('inscricao_id');
            $table->unsignedBigInteger('vaga_id');
            $table->unsignedBigInteger('candidato_id');
            $table->date('data_inscricao');
            $table->boolean('status_inscricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
