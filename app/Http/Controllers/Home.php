<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vaga;
use App\Models\Selecao;
use App\Models\Inscricao;
use App\Models\Candidato;

class Home extends Controller
{
    public function index()
    {
        $vagas = Vaga::all()->count();
        $selecoes = Selecao::all()->count();
        $inscricoes = Inscricao::all()->count();
        $candidatos = Candidato::all()->count();

        return view('dashboard', compact('vagas', 'selecoes', 'inscricoes', 'candidatos'));
    }
}
