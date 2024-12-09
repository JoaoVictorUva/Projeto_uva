<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:border-none w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Editar Seleção</h1>

                <div class="mt-2">
                    <form class="grid grid-cols-1 gap-4" action="{{ route('selecao.update', $selecao->selecao_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Campo de Título -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-white">Título</label>
                            <input type="text" id="titulo" name="titulo"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Título da Seleção"
                                value="{{ $selecao->titulo ?? old('titulo') }}">
                                @error('titulo')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Campos de Edital e Informações Gerais -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="edital" class="block text-sm font-medium text-gray-700 dark:text-white">Edital</label>
                                <div class="mt-1">
                                    <!-- Exibir edital atual, se disponível -->
                                    @if (!empty($selecao->edital))
                                    <a href="{{ asset($selecao->edital) }}" target="_blank" class="text-indigo-600 hover:underline">
                                        Ver edital atual
                                    </a>
                                    @endif
                                    <!-- Upload de novo edital -->
                                    <input type="file" id="edital" name="edital"
                                        class="mt-2 block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 
                                                file:bg-gray-50 file:border file:border-gray-300 file:rounded-md file:px-4 file:py-2 file:text-sm file:font-medium 
                                                hover:file:bg-indigo-100 focus:file:bg-indigo-200">
                                                
                                </div>
                                @error('edital')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="informacoes_gerais" class="block text-sm font-medium text-gray-700 dark:text-white">Informações Gerais</label>
                                <input type="text" id="informacoes_gerais" name="informacoes_gerais"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $selecao->informacoes_gerais ?? old('informacoes_gerais') }}">
                                    @error('informacoes_gerais')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <!-- Campos de Datas -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="inscricao_inicio" class="block text-sm font-medium text-gray-700 dark:text-white">Início da Inscrição</label>
                                <input type="date" id="inscricao_inicio" name="inscricao_inicio"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $selecao->inscricao_inicio ?? old('inscricao_inicio') }}">
                                    @error('inscricao_inicio')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div>
                                <label for="inscricao_fim" class="block text-sm font-medium text-gray-700 dark:text-white">Fim da Inscrição</label>
                                <input type="date" id="inscricao_fim" name="inscricao_fim"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $selecao->inscricao_fim ?? old('inscricao_fim') }}">
                                    @error('inscricao_fim')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <!-- Outros Campos -->
                        <div class="mb-4">
                            <label for="exibir_edital" class="block text-sm font-medium text-gray-700 dark:text-white">Exibir Edital?</label>
                            <select id="exibir_edital" name="exibir_edital"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1" @if (( $selecao->exibir_edital ?? old('exibir_edital')) == 1) selected @endif>Sim</option>
                                <option value="0" @if (( $selecao->exibir_edital ?? old('exibir_edital')) == 0) selected @endif>Não</option>
                            </select>
                            @error('exibir_edital')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="exibir_resultado_inscricao" class="block text-sm font-medium text-gray-700 dark:text-white">Exibir Resultado da Inscrição?</label>
                            <select id="exibir_resultado_inscricao" name="exibir_resultado_inscricao"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1" @if (( $selecao->exibir_resultado_inscricao ?? old('exibir_resultado_inscricao')) == 1) selected @endif>Sim</option>
                                <option value="0" @if (( $selecao->exibir_resultado_inscricao ?? old('exibir_resultado_inscricao')) == 0) selected @endif>Não</option>
                            </select>
                            @error('exibir_resultado_inscricao')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="finalizado" class="block text-sm font-medium text-gray-700 dark:text-white">Finalizado?</label>
                            <select id="finalizado" name="finalizado"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1" @if (( $selecao->finalizado ?? old('finalizado')) == 1) selected @endif>Sim</option>
                                <option value="0" @if (( $selecao->finalizado ?? old('finalizado')) == 0) selected @endif>Não</option>
                            </select>
                            @error('exibir_resultado_inscricao')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="resultado" class="block text-sm font-medium text-gray-700 dark:text-white">Resultado</label>
                            <textarea id="resultado" name="resultado" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $selecao->resultado ?? old('resultado') }}</textarea>
                        </div>

                        <!-- Botão de Submissão -->
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