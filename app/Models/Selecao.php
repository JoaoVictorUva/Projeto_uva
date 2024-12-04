<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selecao extends Model
{
    protected $table = 'selecoes';
    protected $primaryKey = 'selecao_id';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'edital',
        'informacoes_gerais',
        'inscricao_inicio',
        'inscricao_fim',
        'exibir_edital',
        'exibir_resultado_inscricao',
        'finalizado',
        'resultado',
    ];
}
