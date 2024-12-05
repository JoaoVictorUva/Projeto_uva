<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CandidatoController extends Controller
{
    public function index() {
        // Requisição para obter todas as cidades do IBGE
        $cidades = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/municipios')->json();
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();

        $busca = request()->busca;

        if ($busca) {

            $candidatos = Candidato::where('nome_completo', 'like', '%' . $busca . '%')->get();
            return view('admin.candidato.candidato', compact('candidatos', 'cidades', 'estados'));
        
        }else{
            // Buscar todos os candidatos  no banco
            $candidatos = Candidato::all();
        
            // Retornar a view com os dados de candidatos e cidades
            return view('admin.candidato.candidato', compact('candidatos', 'cidades', 'estados'));
        }
        
    }

    public function createAdd() {
        $cidades = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/municipios')->json();
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();
        return view('admin.candidato.create', compact('cidades', 'estados'));
    }

    public function store(Request $request) {
        
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'nome_pai' => 'nullable|string|max:255', // Campo Nome do Pai
            'nome_mae' => 'required|string|max:255', // Campo Nome da Mãe
            'email' => 'required|email|unique:candidatos,email',
            'senha' => 'required|string|min:8',
            'cpf' => 'required|string|size:11|unique:candidatos,cpf',
            'telefone' => 'nullable|string',
            'cidade_id' => 'required|exists:cidades,id',
            'raca_id' => 'required|exists:racas,id',
            'rg' => 'required|string|max:15',
            'nacionalidade' => 'required|string|max:255',
            'nascimento_pais_id' => 'required|exists:paises,id', // País de Nascimento
            'estado_nascimento_id' => 'required|exists:estados,id',
            'nascimento_cidade_id' => 'required|exists:cidades,id',
            'estado_id' => 'required|exists:estados,id', // Estado de residência
            'bairro' => 'required|string|max:255', // Bairro
            'endereco' => 'required|string|max:255', // Endereço
            'cep' => 'required|string|size:8',
            'deficiencia' => 'required|boolean',
            'sexo' => 'required|string|max:1',
            'estado_civil_id' => 'required|exists:estados_civis,id',
            'data_expedicao' => 'required|date',
            'orgao_expeditor' => 'required|string|max:50',
            'uf_expedicao' => 'required|string|size:2',
            'escolaridade' => 'required|string|max:255',
        ]);

        // Removendo máscaras dos dados
        $cpfSemMascara = preg_replace('/\D/', '', $validatedData['cpf']);
        $telefoneSemMascara = preg_replace('/\D/', '', $validatedData['telefone'] ?? '');
        $rgSemMascara = preg_replace('/\D/', '', $validatedData['rg']);
        $cepSemMascara = preg_replace('/\D/', '', $validatedData['cep']);


        // Instanciando um novo candidato
        $candidato = new Candidato();

        // Atribuindo valores aos campos
        $candidato->nome_completo = $validatedData['nome_completo'];
        $candidato->nome_pai = $validatedData['nome_pai'] ?? null;
        $candidato->nome_mae = $validatedData['nome_mae'];
        $candidato->email = $validatedData['email'];
        $candidato->senha = Hash::make($validatedData['senha']); // Criptografar senha
        $candidato->cpf = Hash::make($cpfSemMascara); // Criptografar CPF
        $candidato->telefone = $telefoneSemMascara;
        $candidato->rg = Hash::make($rgSemMascara); // Criptografar RG
        $candidato->nacionalidade = $validatedData['nacionalidade'];
        $candidato->nascimento_pais_id = $validatedData['nascimento_pais_id'];
        $candidato->estado_nascimento_id = $validatedData['estado_nascimento_id'];
        $candidato->nascimento_cidade_id = $validatedData['nascimento_cidade_id'];
        $candidato->estado_id = $validatedData['estado_id'];
        $candidato->bairro = $validatedData['bairro'];
        $candidato->endereco = $validatedData['endereco'];
        $candidato->cep = $cepSemMascara;
        $candidato->deficiencia = $validatedData['deficiencia'];
        $candidato->sexo = $validatedData['sexo'];
        $candidato->estado_civil_id = $validatedData['estado_civil_id'];
        $candidato->data_expedicao = $validatedData['data_expedicao'];
        $candidato->orgao_expeditor = $validatedData['orgao_expeditor'];
        $candidato->uf_expedicao = $validatedData['uf_expedicao'];
        $candidato->escolaridade = $validatedData['escolaridade'];

        // Salvando o candidato no banco de dados
        $candidato->save();

        return response()->json([
            'message' => 'Candidato criado com sucesso!',
            'candidato' => $candidato
        ], 201);
    }

    public function destroy($id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();

        return redirect()->route('candidato')->with('success', 'Candidato excluído com sucesso.');
    }
}
