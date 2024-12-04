<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
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

    public function destroy($id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();

        return redirect()->route('candidato')->with('success', 'Candidato excluído com sucesso.');
    }
}
