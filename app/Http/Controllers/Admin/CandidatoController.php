<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CandidatoController extends Controller
{
    public function index() {
        // Requisição para obter todas as cidades do IBGE
        $cidades = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/municipios')->json();
        $estados = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')->json();

        $racas = Http::get(url('http://127.0.0.1:8000/racas'))->json();
        $estadosCivis = Http::get(url('http://127.0.0.1:8000/estados-civis'))->json(); 

        $busca = request()->busca;


        if ($busca) {

            $candidatos = Candidato::where('nome_completo', 'like', '%' . $busca . '%')->get();
            return view('admin.candidato.candidato', compact('candidatos', 'cidades', 'estados', 'racas', 'estadosCivis'));
        
        }else{
            // Buscar todos os candidatos  no banco
            $candidatos = Candidato::all();
        
            // Retornar a view com os dados de candidatos e cidades
            return view('admin.candidato.candidato', compact('candidatos', 'cidades', 'estados', 'racas', 'estadosCivis'));
        }
        
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
           'raca_id' => 'required',
            'estado_civil_id' => 'required',
            'estado_id' => 'required',
            'cidade_id' => 'required',
            'nascimento_pais_id' => 'required',
            'estado_nascimento_id' => 'required',
            'nascimento_cidade_id' => 'required',
            'nome_completo' => 'required',
            'sexo' => 'required',
            'deficiencia' => 'required',
            'nome_pai' => 'required',
            'nome_mae' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'cep' => 'required',
            'telefone' => 'required',
            'email' => 'required',
            'nacionalidade' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'data_expedicao' => 'required',
            'orgao_expeditor' => 'required',
            'uf_expedicao' => 'required',
            'escolaridade' => 'required',
            'senha' => 'required',
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

    public function destroy($id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();

        return redirect()->route('candidato')->with('success', 'Candidato excluído com sucesso.');
    }
}
