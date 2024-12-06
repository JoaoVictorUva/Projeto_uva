<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vaga;
use App\Models\Selecao;

class VagaController extends Controller
{
    public function index() 
    {   
        $busca = request()->busca;
        if ($busca) {
            $vagas = Vaga::with('selecao')->where('nome_completo', 'like', '%' . $busca . '%')->get();
            return view('admin.vaga.vaga', ['vagas' => $vagas]);
        }else{  
            $vagas = Vaga::all();
            return view('admin.vaga.vaga', ['vagas' => $vagas]);
        }

    }

    public function createAdd() {
        $selecao = Selecao::all();

        return view('admin.vaga.create' , ['selecoes' => $selecao]);
    }

    public function store(Request $request) {


        $validacao = $request->validate([
            'selecao_id' => 'required|exists:selecoes,selecao_id', 
            'cargo_id' => 'required|integer',            
            'curso_id' => 'required|integer',           
            'area_id' => 'required|integer',             
            'tipo_concorrencia' => 'required|string|max:255',
            'valor_inscricao' => 'required',
            'total_vagas' => 'required|integer|min:1',            
            'descricao' => 'required|string', 
        ]);

        $valorSemMascara = preg_replace('/\D/', '', $validacao['valor_inscricao']);

        $vaga = new Vaga();
        $vaga->selecao_id = $request->selecao_id;
        $vaga->cargo_id = $request->cargo_id;
        $vaga->curso_id = $request->curso_id;
        $vaga->area_id = $request->area_id;
        $vaga->tipo_concorrencia = $request->tipo_concorrencia;
        $vaga->valor_inscricao = $valorSemMascara;
        $vaga->total_vagas = $request->total_vagas;
        $vaga->descricao = $request->descricao;
        $vaga->save();

        // Redireciona ou retorna uma resposta de sucesso
        return redirect()->route('vaga')->with('success', 'Vaga cadastrada com sucesso!');

        
    }

    public function destroy($id)
    {
        $vaga = Vaga::findOrFail($id);
        $vaga->delete();

        return redirect()->route('vaga')->with('success', 'Vaga excluída com sucesso.');
    }

}
