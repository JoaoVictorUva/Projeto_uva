<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Vaga;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CandidatoController extends Controller
{
    public function index() {
    
        $busca = request()->busca;

        $cursos = $this->cursos();

        $candidatos = Candidato::with('inscricao', 'inscricao.vaga.selecao')
            ->when( isset($busca) && !empty($busca) ,function($query) use($busca){
                $query->where('nome_completo','like', '%' . $busca . '%')
                ->orWhere('cpf', $busca);
            })->paginate(20);

        return view('admin.candidato.candidato', compact('candidatos', 'busca', 'cursos'));
        
        
    }

    public function createAdd() {
        $cidades = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/municipios')->json();
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();
        
        $racas = Http::get(url('http://127.0.0.1:8000/racas'))->json();
        $estadosCivis = Http::get(url('http://127.0.0.1:8000/estados-civis'))->json(); 

        return view('admin.candidato.create', compact('cidades', 'estados' ,'racas', 'estadosCivis'));
    }

    public function store(Request $request) {
        
        $validacao = $request->validate([
           
            'nome_completo' => 'required|string|max:255',
            'nome_pai' => 'nullable|string|max:255', // Campo Nome do Pai
            'nome_mae' => 'required|string|max:255', // Campo Nome da Mãe
            'email' => 'required|email|unique:candidatos,email',
            'senha' => 'required|string|min:8',
            'cpf' => 'required|string|size:14|unique:candidatos,cpf',
            'telefone' => 'nullable|string',
            'cidade_id' => 'required',
            'raca_id' => 'required',
            'rg' => 'required|string|max:15',
            'nacionalidade' => 'required|string|max:255',
            'nascimento_pais_id' => 'required', // País de Nascimento
            'estado_nascimento_id' => 'required',
            'nascimento_cidade_id' => 'required',
            'estado_id' => 'required', // Estado de residência
            'bairro' => 'required|string|max:255', // Bairro
            'endereco' => 'required|string|max:255', // Endereço
            'cep' => 'required|string|max:10',
            'deficiencia' => 'required|boolean',
            'sexo' => 'required|string|max:1',
            'estado_civil_id' => 'required',
            'data_expedicao' => 'required|date',
            'orgao_expeditor' => 'required|string|max:50',
            'uf_expedicao' => 'required|string|size:2',
            'escolaridade' => 'required|string|max:255',
        ]);

        $cpfSemMascara = preg_replace('/\D/', '', $validacao['cpf']);
        $telefoneSemMascara = preg_replace('/\D/', '', $validacao['telefone'] ?? '');
        $rgSemMascara = preg_replace('/\D/', '', $validacao['rg']);
        $cepSemMascara = preg_replace('/\D/', '', $validacao['cep']);

        $candidato = new Candidato();
        $candidato->raca_id = $request->raca_id;
        $candidato->estado_civil_id = $request->estado_civil_id;
        $candidato->estado_id = $request->estado_id;
        $candidato->cidade_id = $request->cidade_id;
        $candidato->nascimento_pais_id = $request->nascimento_pais_id;
        $candidato->estado_nascimento_id = $request->estado_nascimento_id;
        $candidato->nascimento_cidade_id = $request->nascimento_cidade_id;
        $candidato->nome_completo = $request->nome_completo;
        $candidato->sexo = $request->sexo;
        $candidato->deficiencia = $request->deficiencia;
        $candidato->nome_pai = $request->nome_pai;
        $candidato->nome_mae = $request->nome_mae;
        $candidato->endereco = $request->endereco;
        $candidato->bairro = $request->bairro;
        $candidato->cep = $cepSemMascara;
        $candidato->telefone = $telefoneSemMascara;
        $candidato->email = $request->email;
        $candidato->nacionalidade = $request->nacionalidade;
        $candidato->cpf = $cpfSemMascara;
        $candidato->rg = $rgSemMascara;
        $candidato->data_expedicao = $request->data_expedicao;
        $candidato->orgao_expeditor = $request->orgao_expeditor;
        $candidato->uf_expedicao = $request->uf_expedicao;
        $candidato->escolaridade = $request->escolaridade;
        $candidato->senha =Hash::make($request->senha);
        $candidato->save();

        return redirect()->route('candidato')->with('success', 'Candidato cadastrado com sucesso.');

    }


    public function edit($id)
    {   
        $cidades = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/municipios')->json();
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();
        
        $racas = Http::get(url('http://127.0.0.1:8000/racas'))->json();
        $estadosCivis = Http::get(url('http://127.0.0.1:8000/estados-civis'))->json(); 

        $candidato = Candidato::findOrFail($id);

        return view('admin.candidato.edit', compact('candidato', 'cidades', 'estados', 'racas', 'estadosCivis'));
    }

    public function update(Request $request, $id)
    {
        $validacao = $request->validate([
           
            'nome_completo' => 'required|string|max:255',
            'nome_pai' => 'nullable|string|max:255', // Campo Nome do Pai
            'nome_mae' => 'required|string|max:255', // Campo Nome da Mãe
            'email' => 'required|email|unique:candidatos,email,' . $id . ',candidato_id',
            'senha' => 'required|string|min:8',
            'cpf' => 'required|string|size:14|unique:candidatos,cpf',
            'telefone' => 'nullable|string',
            'cidade_id' => 'required',
            'raca_id' => 'required',
            'rg' => 'required|string|max:15',
            'nacionalidade' => 'required|string|max:255',
            'nascimento_pais_id' => 'required', // País de Nascimento
            'estado_nascimento_id' => 'required',
            'nascimento_cidade_id' => 'required',
            'estado_id' => 'required', // Estado de residência
            'bairro' => 'required|string|max:255', // Bairro
            'endereco' => 'required|string|max:255', // Endereço
            'cep' => 'required|string|max:10',
            'deficiencia' => 'required|boolean',
            'sexo' => 'required|string|max:1',
            'estado_civil_id' => 'required',
            'data_expedicao' => 'required|date',
            'orgao_expeditor' => 'required|string|max:50',
            'uf_expedicao' => 'required|string|size:2',
            'escolaridade' => 'required|string|max:255',
        ]);

        $cpfSemMascara = preg_replace('/\D/', '', $validacao['cpf']);
        $telefoneSemMascara = preg_replace('/\D/', '', $validacao['telefone'] ?? '');
        $rgSemMascara = preg_replace('/\D/', '', $validacao['rg']);
        $cepSemMascara = preg_replace('/\D/', '', $validacao['cep']);

        $candidato = Candidato::findOrFail($id);
        $candidato->raca_id = $request->raca_id;
        $candidato->estado_civil_id = $request->estado_civil_id;
        $candidato->estado_id = $request->estado_id;
        $candidato->cidade_id = $request->cidade_id;
        $candidato->nascimento_pais_id = $request->nascimento_pais_id;
        $candidato->estado_nascimento_id = $request->estado_nascimento_id;
        $candidato->nascimento_cidade_id = $request->nascimento_cidade_id;
        $candidato->nome_completo = $request->nome_completo;
        $candidato->sexo = $request->sexo;
        $candidato->deficiencia = $request->deficiencia;
        $candidato->nome_pai = $request->nome_pai;
        $candidato->nome_mae = $request->nome_mae;
        $candidato->endereco = $request->endereco;
        $candidato->bairro = $request->bairro;
        $candidato->cep = $cepSemMascara;
        $candidato->telefone = $telefoneSemMascara;
        $candidato->email = $request->email;
        $candidato->nacionalidade = $request->nacionalidade;
        $candidato->cpf = $cpfSemMascara;
        $candidato->rg = $rgSemMascara;
        $candidato->data_expedicao = $request->data_expedicao;
        $candidato->orgao_expeditor = $request->orgao_expeditor;
        $candidato->uf_expedicao = $request->uf_expedicao;
        $candidato->escolaridade = $request->escolaridade;
        $candidato->senha =$request->senha;
        $candidato->save();

        return redirect()->route('candidato')->with('success', 'Candidato editado com sucesso.');

    }
    

    public function destroy($id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();

        return redirect()->route('candidato')->with('success', 'Candidato excluído com sucesso.');
    }

    public function cursos()
    {
        return [
            ['id' => 1, 'descricao' => 'Informática'],
            ['id' => 2, 'descricao' => 'Mecânica'],
            ['id' => 3, 'descricao' => 'Eletrônica'],
            ['id' => 4, 'descricao' => 'Civil'],
            ['id' => 5, 'descricao' => 'Engenharia'],
        ];
    }
}
