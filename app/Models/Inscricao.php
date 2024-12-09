<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{   
    protected $table = 'inscricoes';

    protected $primaryKey = 'inscricao_id';
    public $timestamps = false;

    protected $fillable = [
        'vaga_id',
        'candidato_id',
        'data_inscricao',
        'status_inscricao',
    ];

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id', 'vaga_id');
    }

    public function candidato()
    {
        return $this->belongsTo(Vaga::class, 'candidato_id', 'candidato_id');
    }
}
