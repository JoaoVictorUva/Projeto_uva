<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:border-none w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Cadastro de Seleção</h1>

                <!-- Adicionando overflow-x-auto para rolagem horizontal -->
                <div class="mt-2">
                    <form class="grid grid-cols-1 gap-4" action="{{ route('selecao.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div>
                                <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-white">Titulo</label>
                                <input type="text" id="titulo" name="titulo" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="Titulo da Seleção">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="edital" class="block text-sm font-medium text-gray-700 dark:text-white">Edital</label>
                                <div class="mt-1 flex items-center">
                                    <input type="file" id="edital" name="edital" required 
                                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 
                                                file:bg-gray-50 file:border file:border-gray-300 file:rounded-md file:px-4 file:py-2 file:text-sm file:font-medium 
                                                hover:file:bg-indigo-100 focus:file:bg-indigo-200">
                                </div>
                            </div>
                            <div>
                                <label for="informacoes_gerais" class="block text-sm font-medium text-gray-700 dark:text-white ">Informações Gerais</label>
                                <input type="text" id="informacoes_gerais" name="informacoes_gerais" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 ">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="inscricao_inicio" class="block text-sm font-medium text-gray-700 dark:text-white ">Inicio da Inscricao</label>
                                <input type="date" id="inscricao_inicio" name="inscricao_inicio" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " >
                            </div>


                            <div>
                                <label for="inscricao_fim" class="block text-sm font-medium text-gray-700 dark:text-white ">Fim da Inscricao</label>
                                <input type="date" id="inscricao_fim" name="inscricao_fim" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " >
                            </div>
  
                        </div>
 
                        <div class="mb-4">
                            <label for="exibir_edital" class="block text-sm font-medium text-gray-700 dark:text-white ">Exibir Edital?</label>
                            <select id="exibir_edital" name="exibir_edital" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="exibir_resultado_inscricao" class="block text-sm font-medium text-gray-700 dark:text-white ">Exibir Resultado da Inscrição?</label>
                            <select id="exibir_resultado_inscricao" name="exibir_resultado_inscricao" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="finalizado" class="block text-sm font-medium text-gray-700 dark:text-white ">Finalizado?</label>
                            <select id="finalizado" name="finalizado" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="resultado" class="block text-sm font-medium text-gray-700 dark:text-white ">Resultado</label>
                            <textarea id="resultado" name="resultado" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>

                            
                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>