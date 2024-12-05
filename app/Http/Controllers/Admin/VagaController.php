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

        $request->all();
        
    }

    public function destroy($id)
    {
        $vaga = Vaga::findOrFail($id);
        $vaga->delete();

        return redirect()->route('vaga')->with('success', 'Vaga excluída com sucesso.');
    }

}
