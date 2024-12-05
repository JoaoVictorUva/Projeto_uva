<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Selecao;
use App\Models\Vaga;
class SelecaoController extends Controller
{
    public function index() {   
        $busca = request()->busca;
        if ($busca) {
            $selecoes = Selecao::where('titulo', 'like', '%' . $busca . '%')->get();
            return view('admin.selecao.selecao', ['selecoes' => $selecoes]);
        }else{
            $selecoes = Selecao::all();

            return view('admin.selecao.selecao', ['selecoes' => $selecoes]);
        }
        
    }

    public function createAdd() {
        return view('admin.selecao.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'edital' => 'required|string|max:255',
            'informacoes_gerais' => 'required|string',
            'inscricao_inicio' => 'required|date',
            'inscricao_fim' => 'required|date|after_or_equal:inscricao_inicio', // A data de fim deve ser maior ou igual à de início
            'exibir_edital' => 'required|boolean',
            'exibir_resultado_inscricao' => 'required|boolean',
            'finalizado' => 'required|boolean',
            'resultado' => 'nullable|string', // O resultado pode ser opcional
        ]);

        // Instanciando um novo registro para a tabela selecoes
        $selecao = new Selecao();

        // Atribuindo os dados validados aos campos
        $selecao->titulo = $validatedData['titulo'];
        $selecao->edital = $validatedData['edital'];
        $selecao->informacoes_gerais = $validatedData['informacoes_gerais'];
        $selecao->inscricao_inicio = $validatedData['inscricao_inicio'];
        $selecao->inscricao_fim = $validatedData['inscricao_fim'];
        $selecao->exibir_edital = $validatedData['exibir_edital'];
        $selecao->exibir_resultado_inscricao = $validatedData['exibir_resultado_inscricao'];
        $selecao->finalizado = $validatedData['finalizado'];
        $selecao->resultado = $validatedData['resultado'] ?? null; // O resultado pode ser nulo

        // Salvando o novo registro na tabela 'selecoes'
        $selecao->save();

        // Retornando a resposta de sucesso
        return response()->json([
            'message' => 'Seleção criada com sucesso!',
            'selecao' => $selecao
        ], 201);
    }

    public function destroy($id)
    {   
        $selecao = Selecao::findOrFail($id);

        $vaga = Vaga::where('selecao_id', $selecao->selecao_id)->first();

        if ($vaga) {
            return redirect()->route('selecao')->with('error', 'Seleção não pode ser excluída pois tem uma vaga associada a ela!');
        }else{
            $selecao->delete();
            return redirect()->route('selecao')->with('success', 'Seleção excluída com sucesso.');
        }
    }

}
