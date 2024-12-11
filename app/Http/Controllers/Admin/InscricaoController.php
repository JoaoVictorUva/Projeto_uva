<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\Vaga;
use App\Models\Selecao;
use App\Models\Candidato;

class InscricaoController extends Controller
{
    public function index()
    {   
        $busca = trim(request()->busca); //id da selecao

        $selecoes = Selecao::all();
        
        $vaga = Vaga::findOrFail($busca );

        if (isset($vaga) && !empty($vaga)) {
            dd($vaga);
        }
        $inscricoes = Inscricao::with('candidato', 'vaga.selecao')  
            ->when( isset($busca) && !empty($busca) ,function($query) use($busca){
                $query->where('vaga_id', $busca);
            })->paginate(4);

            return view('admin.inscricao.inscricao', compact('inscricoes', 'busca', 'selecoes'));
    }

    public function createAdd()
    {   
        $selecoes = Selecao::all();

        $candidatos = Candidato::all();

        return view('admin.inscricao.create', compact('selecoes', 'candidatos'));
    }

    public function store(Request $request) {


        $validacao = $request->validate([
            'selecao_id' => 'required|exists:selecoes,selecao_id', 
            'candidato_id' => 'required|exists:candidatos,candidato_id',
        ]);

        $vaga = Vaga::where('selecao_id', $request->selecao_id)->first();
        
        $inscricao = Inscricao::where('vaga_id', $vaga->vaga_id)->where('candidato_id', $request->candidato_id)->first();

        if ($inscricao) {
            return redirect()->back()->with('error', 'Candidato já inscrito nesta Seleção!');
        }else{
            $inscricao = new Inscricao();
            $inscricao->vaga_id = $vaga->vaga_id;
            $inscricao->candidato_id = $request->candidato_id;
            $inscricao->data_inscricao = now();
            $inscricao->status_inscricao = true;
            $inscricao->save();

            return redirect()->route('inscricao')->with('success', 'Candidato inscrito com sucesso!');
        }
        

    }
}
