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
        Schema::create('vagas', function (Blueprint $table) {
            $table->id('vaga_id');
            $table->unsignedBigInteger('selecao_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('area_id');
            $table->string('tipo_concorrencia');
            $table->integer('valor_inscricao');
            $table->integer('total_vagas');  
            $table->string('descricao');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
