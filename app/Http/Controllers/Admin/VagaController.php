<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vaga;
use App\Models\Selecao;
use App\Models\Inscricao;


class VagaController extends Controller
{
    public function index() 
    {   
        $busca = trim(request()->busca);

        $cursos = $this->cursos();
        $cargos = $this->cargos();
        $areas = $this->areas();

        $vagas = Vaga::with('selecao')
            ->when( isset($busca) && !empty($busca) ,function($query) use($busca){
                $query->where('curso_id', $busca);
            })->paginate(10);

            return view('admin.vaga.vaga', compact('vagas', 'busca', 'cursos', 'cargos', 'areas'));
    }

    public function createAdd() {
        $selecoes = Selecao::all();

        $cursos = $this->cursos();
        $cargos = $this->cargos();
        $areas = $this->areas();

        return view('admin.vaga.create' , compact('selecoes', 'cursos', 'cargos', 'areas'));
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

    public function edit($id)
    {
        $cursos = $this->cursos();
        $cargos = $this->cargos();
        $areas = $this->areas();

        $vaga = Vaga::find($id);
        $selecoes = Selecao::all();
        return view('admin.vaga.edit', compact('vaga', 'selecoes', 'cursos', 'cargos', 'areas'));
    }

    public function update(Request $request, $id)
    {
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

        $vaga = Vaga::findOrFail($id);
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
        return redirect()->route('vaga')->with('success', 'Vaga atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $vaga = Vaga::findOrFail($id);

        $inscricao = Inscricao::where('vaga_id', $vaga->vaga_id)->first();

        if ($inscricao) {
            return redirect()->route('vaga')->with('error', 'Vaga não pode ser excluída pois tem uma inscrição associada a ela!');
        } else {
            $vaga->delete();
            return redirect()->route('vaga')->with('success', 'Vaga excluída com sucesso.');
        }

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
    public function cargos()
    {
        return [
            ['id' => 1, 'descricao' => 'Informática'],
            ['id' => 2, 'descricao' => 'Mecânica'],
            ['id' => 3, 'descricao' => 'Eletrônica'],
            ['id' => 4, 'descricao' => 'Civil'],
            ['id' => 5, 'descricao' => 'Engenharia'],
        ];
    }

    public function areas()
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
