<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Selecao;
use App\Models\Vaga;

class SelecaoController extends Controller
{
    public function index()
    {
    
        $busca = trim(request()->busca);

        $selecoes = Selecao::when( isset($busca) && !empty($busca) ,function($query) use($busca){
                $query->where('titulo','like', '%' . $busca . '%');
            })->paginate(20);

            return view('admin.selecao.selecao', compact('selecoes', 'busca'));

    }
    public function createAdd()
    {
        return view('admin.selecao.create');
    }


    public function store(Request $request)
    {

        // Validação dos dados recebidos
        $validacao = $request->validate([
            'titulo' => 'required|string|max:255',
            'edital' => 'required|file|mimes:pdf|max:2048', // Validando como arquivo PDF
            'informacoes_gerais' => 'required|string',
            'inscricao_inicio' => 'required|date',
            'inscricao_fim' => 'required|date|after_or_equal:inscricao_inicio',
            'exibir_edital' => 'required|boolean',
            'exibir_resultado_inscricao' => 'required|boolean',
            'finalizado' => 'required|boolean',
            'resultado' => 'nullable|string',
        ]);



        // Instanciando um novo registro para a tabela selecoes
        $selecao = new Selecao();
        $selecao->titulo = $validacao['titulo'];
        $selecao->informacoes_gerais = $validacao['informacoes_gerais'];
        $selecao->inscricao_inicio = $validacao['inscricao_inicio'];
        $selecao->inscricao_fim = $validacao['inscricao_fim'];
        $selecao->exibir_edital = $validacao['exibir_edital'];
        $selecao->exibir_resultado_inscricao = $validacao['exibir_resultado_inscricao'];
        $selecao->finalizado = $validacao['finalizado'];
        $selecao->resultado = $validacao['resultado'];



        // Salvando o arquivo na pasta public/documents
        if ($request->hasFile('edital')) {
            $file = $request->file('edital'); // Obtemos o arquivo
            $destinationPath = 'documents'; // Caminho completo até a pasta "documents"
            $fileName = time() . '_' . $file->getClientOriginalName(); // Geramos um nome único para o arquivo
            $path = $destinationPath . '/' . $fileName;
            $file->move($destinationPath, $fileName); // Movemos o arquivo para "public/documents"

            // Armazenamos o caminho relativo no banco de dados
            $selecao->edital = $path;
        }

        $selecao->save();

        // Retornando a resposta de sucesso
        return redirect()->route('selecao')->with('success', 'Seleção cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $selecao = Selecao::findOrFail($id);

        return view('admin.selecao.edit', compact('selecao'));
    }

    public function update(Request $request, $id)
    {
        // Localizar a seleção pelo ID
        $selecao = Selecao::findOrFail($id);


        // Validar os dados recebidos
        $validacao = $request->validate([
            'titulo' => 'required|string|max:255',
            'edital' => 'file|mimes:pdf',
            'informacoes_gerais' => 'required|string',
            'inscricao_inicio' => 'required|date',
            'inscricao_fim' => 'required|date|after_or_equal:inscricao_inicio',
            'exibir_edital' => 'required|boolean',
            'exibir_resultado_inscricao' => 'required|boolean',
            'finalizado' => 'required|boolean',
            'resultado' => 'nullable|string',
        ]);

        if ($request->hasFile('edital') == false) {

            $selecao = Selecao::findOrFail($id);

            $selecao->titulo = $validacao['titulo'];
            $selecao->informacoes_gerais = $validacao['informacoes_gerais'];
            $selecao->inscricao_inicio = $validacao['inscricao_inicio'];
            $selecao->inscricao_fim = $validacao['inscricao_fim'];
            $selecao->exibir_edital = $validacao['exibir_edital'];
            $selecao->exibir_resultado_inscricao = $validacao['exibir_resultado_inscricao'];
            $selecao->finalizado = $validacao['finalizado'];
            $selecao->resultado = $validacao['resultado'];

            $selecao->save();

            return redirect()->route('selecao')->with('success', 'Seleção editada com sucesso!');
        }else {

            $selecao = Selecao::findOrFail($id);

            $selecao->titulo = $validacao['titulo'];
            $selecao->informacoes_gerais = $validacao['informacoes_gerais'];
            $selecao->inscricao_inicio = $validacao['inscricao_inicio'];
            $selecao->inscricao_fim = $validacao['inscricao_fim'];
            $selecao->exibir_edital = $validacao['exibir_edital'];
            $selecao->exibir_resultado_inscricao = $validacao['exibir_resultado_inscricao'];
            $selecao->finalizado = $validacao['finalizado'];
            $selecao->resultado = $validacao['resultado'];

            // Verificar se um novo arquivo foi enviado
            if ($request->hasFile('edital')) {
                $file = $request->file('edital'); // Obtemos o arquivo
                $destinationPath = 'documents'; // Caminho completo até a pasta "documents"
                $fileName = time() . '_' . $file->getClientOriginalName(); // Geramos um nome único para o arquivo
                $path = $destinationPath . '/' . $fileName;
                $file->move($destinationPath, $fileName); // Movemos o arquivo para "public/documents"

                // Armazenamos o caminho relativo no banco de dados
                $selecao->edital = $path;
            }

            // Salvar as alterações
            $selecao->save();

            return redirect()->route('selecao')->with('success', 'Seleção editada com sucesso!');
        }

        
    }

    public function destroy($id)
    {
        $selecao = Selecao::findOrFail($id);

        $vaga = Vaga::where('selecao_id', $selecao->selecao_id)->first();

        if ($vaga) {
            return redirect()->route('selecao')->with('error', 'Seleção não pode ser excluída pois tem uma vaga associada a ela!');
        } else {
            $selecao->delete();
            return redirect()->route('selecao')->with('success', 'Seleção excluída com sucesso.');
        }
    }
}
