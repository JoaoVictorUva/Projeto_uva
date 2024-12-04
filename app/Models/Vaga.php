<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = 'vagas';

    protected $primaryKey = 'vaga_id';
    public $timestamps = false;

    protected $fillable = [
        'selecao_id',
        'cargo_id',
        'curso_id',
        'area_id',
        'tipo_concorrencia',
        'valor_incricao',
        'total_vagas',
        'descricao',
    ];

    public function selecao()
    {
        return $this->belongsTo(Selecao::class, 'selecao_id', 'selecao_id');
    }
}
