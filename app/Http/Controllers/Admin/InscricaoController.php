<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inscricao;

class InscricaoController extends Controller
{
    public function index()
    {   
        $busca = trim(request()->busca);

        $inscricoes = Inscricao::with('vaga', 'vaga.selecao')
            ->when( isset($busca) && !empty($busca) ,function($query) use($busca){
                $query->where('vaga_id', $busca);
            })->paginate(10);

            return view('admin.inscricao.inscricao', compact('inscricoes', 'busca'));
    }

    public function createAdd()
    {
        return view('admin.inscricao.create');
    }
}
