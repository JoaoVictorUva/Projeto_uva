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

    public function store(Request $request) {
        dd($request->all());
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
