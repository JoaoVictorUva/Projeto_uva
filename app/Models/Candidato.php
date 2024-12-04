<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $table = 'candidatos';

    protected $primaryKey = 'candidato_id';
    public $timestamps = false;

    protected $fillable = [
        'raca_id',
        'estado_civil_id',
        'cidade_id',
        'nascimento_pais_id',
        'estado_nascimento_id',
        'nascimento_cidade_id',
        'nome_completo',
        'sexo',
        'deficiencia',
        'nome_pai',
        'nome_mae',
        'endereco',
        'bairro',
        'cep',
        'telefone',
        'email',
        'nacionalidade',
        'cpf',
        'rg',
        'data_expedicao',
        'orgao_expeditor',
        'uf_expedicao',
        'escolaridade',
        'senha'
    ];

}
