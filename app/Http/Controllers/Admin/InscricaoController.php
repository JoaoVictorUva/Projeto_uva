<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\Vaga;
use App\Models\Selecao;

class InscricaoController extends Controller
{
    public function index()
    {   
        $busca = trim(request()->busca); //id da selecao

        $selecoes = Selecao::all();
        
        $vaga = Vaga::where('selecao_id', $busca)->get();

        $inscricoes = Inscricao::with('vaga', 'vaga.selecao')  
            ->when( isset($busca) && !empty($busca) ,function($query) use($vaga){
                $query->where('vaga_id', $vaga->vaga_id);
            })->paginate(10);

            return view('admin.inscricao.inscricao', compact('inscricoes', 'busca', 'selecoes'));
    }

    public function createAdd()
    {
        return view('admin.inscricao.create');
    }
}
