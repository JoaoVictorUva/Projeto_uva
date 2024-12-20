<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:border-none  w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Vagas</h1>
                <div class="flex justify-between ">
                        <form class="flex items-center justify-center gap-3" action="{{ route('vaga') }}" method="get">
                            <select id="busca" name="busca"  class="  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('curso_id') }}">
                                <option value="">Todos os Curso</option>
                                @foreach ($cursos as $curso)    
                                    <option value="{{ $curso['id'] }}" @if(old('curso_id') == $curso['id']) selected @endif >{{ $curso['descricao'] }}</option>
                                @endforeach     
                            </select>
        
                            <button class="border border-gray-300 flex items-center justify-center gap-1 px-2 py-2 mt-0.5 rounded-md  dark:text-white" type="submit"><i class="fas fa-search dark:text-white"></i> Buscar</button>

                        </form>
                        
                    

                    <a href="{{ route('vaga.create') }}" class="bg-green-600 text-white font-bold rounded-md px-4 py-0.5 flex items-center justify-center">Novo +</a>
                </div>
                
                @if(session('success'))
                    <div id="errorMessage" class="absolute top-16 right-0 mt-3 mr-3 p-3 rounded-md text-white bg-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div id="successMessage" class="absolute top-16 right-0 mt-3 mr-3 p-3 rounded-md text-white bg-red-600">
                        {{ session('error') }}
                    </div>
                @endif

                <script>
                    // Verifica se há uma mensagem de sucesso
                    @if(session('success'))
                        window.onload = function() {
                            // Exibe a mensagem
                            const message = document.getElementById('successMessage');
                            message.classList.remove('hidden');
                            
                            // Esconde a mensagem após 3 segundos
                            setTimeout(function() {
                                message.classList.add('hidden');
                            }, 4000);  // 3000 milissegundos = 3 segundos
                        }
                    @endif

                    @if(session('error'))
                        window.onload = function() {
                            // Exibe a mensagem
                            const message = document.getElementById('errorMessage');
                            message.classList.remove('hidden');
                            
                            // Esconde a mensagem após 3 segundos
                            setTimeout(function() {
                                message.classList.add('hidden');
                            }, 4000);  // 3000 milissegundos = 3 segundos
                        }
                    @endif
                </script>


                <!-- Adicionando overflow-x-auto para rolagem horizontal -->
                <div class="overflow-x-auto mt-2">
                    <table class="table-auto w-full my-3">
                        <thead class="border-t bg-transparent dark:bg-transparent my-2">
                            <tr class="border-b border-gray-300 ">
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Seleção</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Cargo</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Curso</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Área</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Tipo de Concorrẽncia</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Valor da Inscrição</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Total de Vagas</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Descrição</td>
                                <td class="px-4 text-center text-gray-500 dark:text-white py-2 whitespace-nowrap">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vagas as $vaga)
                                <tr class="border-b border-gray-300 bg-transparent hover:bg-gray-200 dark:bg-transparent">
                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">{{ $vaga->selecao->titulo }}</td>
                                    
                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">
                                        @foreach($cargos as $cargo)
                                            @if($vaga->cargo_id == $cargo['id'])
                                                {{ $cargo['descricao'] }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">
                                        @foreach($cursos as $curso)
                                            @if($vaga->curso_id == $curso['id'])
                                                {{ $curso['descricao'] }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">
                                        @foreach($areas as $area)
                                            @if($vaga->area_id == $area['id'])
                                                {{ $area['descricao'] }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">{{ $vaga->tipo_concorrencia }}</td>
                                    <td class="inscricao px-4 py-2 dark:text-white  whitespace-nowrap">{{ $vaga->valor_inscricao }}</td>
                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">{{ $vaga->total_vagas }}</td>
                                    <td class="px-4 py-2 dark:text-white  whitespace-nowrap">{{ $vaga->descricao }}</td>
                                    <td class="px-4 text-left flex gap-2 text-gray-500 py-2 whitespace-nowrap">
                                        <a  href="{{ route('vaga.edit', $vaga->vaga_id) }}" class="px-2 py-1 bg-blue-500 text-white rounded-md">Editar</a>
                                        <form action="{{ route('vaga.destroy', $vaga->vaga_id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-md">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(isset($busca))

                    {{$vagas->withQueryString($busca)->links() }}
                    
                @else
                    {{ $vagas->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>