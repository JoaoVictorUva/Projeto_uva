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
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id('candidato_id');
            $table->unsignedBigInteger('raca_id');  
            $table->unsignedBigInteger('estado_civil_id');  
            $table->unsignedBigInteger('estado_id'); 
            $table->unsignedBigInteger('cidade_id');  
            $table->unsignedBigInteger('nascimento_pais_id');  
            $table->unsignedBigInteger('estado_nascimento_id');  
            $table->unsignedBigInteger('nascimento_cidade_id');  
            $table->string('nome_completo');  
            $table->char('sexo', 1);  
            $table->boolean('deficiencia');  
            $table->string('nome_pai');  
            $table->string('nome_mae');  
            $table->string('endereco');  
            $table->string('bairro');  
            $table->string('cep');  
            $table->string('telefone');  
            $table->string('email');  
            $table->string('nacionalidade');  
            $table->string('cpf');  
            $table->string('rg');  
            $table->date('data_expedicao');  
            $table->string('orgao_expeditor');  
            $table->string('uf_expedicao');  
            $table->string('escolaridade');
            $table->string('senha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
