<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  dark:bg-gray-800 dark:border-none  w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Candidatos</h1>
                <div class="flex justify-between ">
                    <div class="border border-gray-300 rounded-md px-3 py-1 flex items-center justify-center">
                        <i class="fas fa-search dark:text-white"></i>
                        <form action="{{ route('candidato') }}" method="get">
                            <input class="border-none px-3 py-1 bg-white focus:outline-none !important dark:bg-transparent dark:text-white" type="text" name="busca" id="busca" placeholder="Buscar por Nome ou CPF" value="{{ isset($busca) ? $busca : '' }}">
                        </form>
                        
                   

                    </div>

                    <a href="{{ route('candidato.create') }}" class="bg-green-600 text-white font-bold rounded-md px-4 py-0.5 flex items-center justify-center">Novo +</a>
                </div>
                @if(session('success'))
                    <div id="successMessage" class="absolute top-16 right-0 mt-3 mr-3 p-3 rounded-md text-white bg-green-600">
                        {{ session('success') }}
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
                </script>

                <!-- Adicionando overflow-x-auto para rolagem horizontal -->
                <div class="overflow-x-auto mt-2">
                    <table class="table-auto w-full mb-3">
                        <thead class="border-t bg-white dark:bg-transparent">
                            <tr class="border-b border-gray-300 ">
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Inscrição</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">CPF</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Nome Completo</td>
                                
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Seleção</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Curso</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Tipo de concorrência</td>
                                <td class="px-4 text-center text-gray-500 dark:text-white py-2 whitespace-nowrap">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidatos as $candidato)
                                <tr class="border-b border-gray-300 bg-white hover:bg-gray-200 dark:bg-transparent">
                                    
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{$candidato->inscricao ? $candidato->inscricao->inscricao_id : '-'}}</td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap cpf">
                                        {{ $candidato->cpf }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ $candidato->nome_completo }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->inscricao->vaga->selecao->titulo ?? '-' }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        @foreach($cursos as $curso)
                                            @if($candidato->inscricao?->vaga?->curso_id == $curso['id'])
                                                {{ $curso['descricao'] }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->inscricao->vaga->tipo_concorrencia ?? '-'}}</td>
                                    

                                    
                                    <td class="px-4 flex gap-2 py-2 text-gray-500 dark:text-white whitespace-nowrap">
                                        <a href="{{ route('candidato.edit', $candidato->candidato_id) }}" class="px-2 py-1 bg-blue-500 text-white rounded-md">Editar</a>
                                        <form action="{{ route('candidato.destroy', $candidato->candidato_id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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

                            {{$candidatos->withQueryString($busca)->links() }}
                            
                        @else
                            {{ $candidatos->links() }}
                        @endif
                    <div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>