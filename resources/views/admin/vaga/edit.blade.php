<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:border-none w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Editar Vaga</h1>

                <div class="mt-2">
                
                    <form class="grid grid-cols-1 gap-4" action="{{ route('vaga.update', $vaga->vaga_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="selecao_id" class="block text-sm font-medium text-gray-700">Seleção</label>
                            <select id="selecao_id" name="selecao_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Selecione uma Seleção</option>
                                @foreach ($selecoes as $selecao)
                                    <option value="{{ $selecao->selecao_id }}" @if(($vaga->selecao_id ?? old('selecao_id'))  ==  $selecao->selecao_id  ) selected @endif>{{ $selecao->titulo }}</option>
                                @endforeach
                            </select>
                            @error('selecao_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

            
                        <div class="mb-4">
                            <label for="cargo_id" class="block text-sm font-medium text-gray-700">Cargo</label>
                            <select id="cargo_id" name="cargo_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Selecione o Cargo</option>
                                <option value="1"  @if(($vaga->cargo_id ?? old('cargo_id'))  ==  1  ) selected @endif>asdasd</option>
                            </select>
                            @error('cargo_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="curso_id" class="block text-sm font-medium text-gray-700">Curso</label>
                            <select id="curso_id" name="curso_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Selecione o Curso</option>
                                    <option value="1"  @if(($vaga->curso_id ?? old('curso_id'))  ==  1  ) selected @endif>asdasd</option>
                            </select>
                            @error('curso_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="area_id" class="block text-sm font-medium text-gray-700">Área</label>
                            <select id="area_id" name="area_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Selecione a Área</option>
                                    <option value="1"  @if(($vaga->area_id ?? old('area_id'))  ==  1  ) selected @endif>asdasdas</option>
                            </select>
                            @error('area_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-3 gap-4">

                            <div class="mb-4">
                                <label for="tipo_concorrencia" class="block text-sm font-medium text-gray-700">Tipo de Concorrência</label>
                                <input type="text" id="tipo_concorrencia" name="tipo_concorrencia"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $vaga->tipo_concorrencia ?? old('tipo_concorrencia')}}">
                            </div>
                            @error('tipo_concorrencia')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror

                            <div class="mb-4">
                                <label for="valor_inscricao" class="block text-sm font-medium text-gray-700">Valor da Inscrição</label>
                                <input type="text" id="valor_inscricao" name="valor_inscricao" step="0.01"  class="inscricao mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $vaga->valor_inscricao ?? old('valor_inscricao')}}">
                            </div>
                            @error('valor_inscricao')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror

                            <div class="mb-4">
                                <label for="total_vagas" class="block text-sm font-medium text-gray-700">Total de Vagas</label>
                                <input type="number" id="total_vagas" name="total_vagas"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $vaga->total_vagas ?? old('total_vagas')}}">
                            </div>
                            @error('total_vagas')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea id="descricao" name="descricao" rows="4"  class="mt-1 block w-full h-32 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $vaga->descricao ?? old('descricao')}}</textarea>
                        </div>
                        @error('descricao')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror

                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Editar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>