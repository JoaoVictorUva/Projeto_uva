<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:border-none  w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Selecao</h1>
                <div class="flex justify-between border-t border-gray-300 pt-2">
                    <div class="border border-gray-300 rounded-md px-3 py-1 flex items-center justify-center">
                        <i class="fas fa-search dark:text-white"></i>

                        <form action="{{ route('selecao') }}" method="get">
                            <input class="border-none px-3 py-1 bg-white focus:outline-none !important dark:bg-transparent dark:text-white" type="text" name="busca" id="busca" placeholder="Busca">
                        </form>

                    </div>
                    
                    <a href="{{ route('selecao.create') }}" class="bg-green-600 text-white font-bold rounded-md px-4 py-0.5 flex items-center justify-center">add +</a>
                </div>
                
                @if(session('success'))
                    <div id="successMessage" class="absolute top-16 right-0 mt-3 mr-3 p-3 rounded-md text-white bg-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div id="errorMessage" class="absolute top-16 right-0 mt-3 mr-3 p-3 rounded-md text-white bg-red-600">
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
                            
                            // Esconde a mensagem após 4 segundos
                            setTimeout(function() {
                                message.classList.add('hidden');
                            }, 4000);  
                        }
                    @endif

                     // Verifica se há uma mensagem de error
                     @if(session('error'))
                        window.onload = function() {
                            // Exibe a mensagem
                            const message = document.getElementById('errorMessage');
                            message.classList.remove('hidden');
                            
                            // Esconde a mensagem após 5 segundos
                            setTimeout(function() {
                                message.classList.add('hidden');
                            }, 5000); 
                        }
                    @endif
                </script>


                <!-- Adicionando overflow-x-auto para rolagem horizontal -->
                <div class="overflow-x-auto mt-2">
                    <table class="table-auto w-full mb-3">
                        <thead class="border-t bg-white dark:bg-transparent">
                            <tr class="border-b border-gray-300 ">
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Titulo</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Informações Gerais</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Inicio da Inscrição</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Fim da Inscrição</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Finalizado</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Resultado</td>
                                <td class="px-4 text-center text-gray-500 dark:text-white py-2 whitespace-nowrap">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($selecoes as $selecao)
                                <tr class="border-b border-gray-300 bg-white hover:bg-gray-200 dark:bg-transparent">
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $selecao->titulo }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $selecao->informacoes_gerais }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap" id="inscricao_inicio">{{ $selecao->inscricao_inicio }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap" id="inscricao_fim" >{{ $selecao->inscricao_fim }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $selecao->finalizado ? 'Sim' : 'Não' }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $selecao->resultado }}</td>
                                    <td class="px-4 text-left flex gap-2 text-gray-500 py-2 whitespace-nowrap">
                                        @if($selecao->edital)
                                            <a href="{{ asset( $selecao->edital) }}" target="_blank" class="bg-black px-2 py-2 rounded-md text-white">Edital</a>
                                        @else
                                            <a href="#" class="bg-black px-2 py-2 rounded-md text-white hover:cursor-not-allowed">Edital</a>
                                        @endif
                                        <button class="px-2 py-1 bg-blue-500 text-white rounded-md">Editar</button>
                                        <form action="{{ route('selecao.destroy', $selecao->selecao_id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-500 text-white rounded-md">
                                                Excluir
                                            </button>
                                        </form>

                                    </td>    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                var mask = new Inputmask('99/99/9999', {
                    greedy: false,  // Evita que a máscara preencha com '_'
                    onincomplete: function () {
                        // Remove o caractere '_' caso a data não seja preenchida completamente
                        this.el.inputmask.setValue(this.el.inputmask.unmaskedvalue().slice(0, -1));
                    }
                });

                var dataIncricaoInicio = document.getElementById('inscricao_inicio');
                var dataIncricaoFim = document.getElementById('inscricao_fim');

                mask.mask(dataIncricaoInicio);
                mask.mask(dataIncricaoFim);
            </script>
        </div>
    </div>
</x-app-layout>