<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  dark:bg-gray-800 dark:border-none  w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Candidatos</h1>
                <div class="flex justify-between ">
                    <div class="border border-gray-300 rounded-md px-3 py-1 flex items-center justify-center">
                        <i class="fas fa-search dark:text-white"></i>
                        <form action="{{ route('candidato') }}" method="get">
                            <input class="border-none px-3 py-1 bg-white focus:outline-none !important dark:bg-transparent dark:text-white" type="text" name="busca" id="busca" placeholder="Busca">
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
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Nome Completo</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Sexo</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Deficiencia</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Nome do Pai</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Nome da Mae</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Endereço</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">bairro</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Raça</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Estado Civil</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Estado</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Cidade</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">País de Nascimento</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Estado de Nascimento</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Cidade de Nascimento</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">cep</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Telefone</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Email</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Nacionalidade</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Cpf</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Rg</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Data de Expedição</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Orgão Expeditor</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">UF Expedição</td>
                                <td class="px-4 text-left text-gray-500 dark:text-white py-2 whitespace-nowrap">Escolaridade</td>
                                <td class="px-4 text-center text-gray-500 dark:text-white py-2 whitespace-nowrap">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidatos as $candidato)
                                <tr class="border-b border-gray-300 bg-white hover:bg-gray-200 dark:bg-transparent">
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->nome_completo }}</td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ $candidato->sexo === 'f' ? 'Feminino' : ($candidato->sexo === 'm' ? 'Masculino' : 'Não especificado') }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ $candidato->deficiencia == '1' ? 'Possui' : ($candidato->deficiencia == '0' ? 'Não possui' : 'Não especificado') }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->nome_pai }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->nome_mae }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->endereco }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->bairro }}</td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ collect($racas)->firstWhere('id', 2)['descricao'] ?? 'Raça não especificada' }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ collect($estadosCivis)->firstWhere('id', $candidato->estado_civil_id)['descricao'] ?? 'Estado civil não especificado' }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ collect($estados)->firstWhere('id', $candidato->estado_id)['nome'] ?? 'Estado não encontrado' }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ collect($cidades)->firstWhere('id', $candidato->cidade_id)['nome'] ?? 'Cidade não encontrada' }}    
                                    </td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ $candidato->nascimento_pais_id == 1 ? 'Brasil' : 'Outro País' }}   
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ collect($estados)->firstWhere('id', $candidato->estado_nascimento_id)['nome'] ?? 'Estado não encontrado' }}
                                    </td>

                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">
                                        {{ collect($cidades)->firstWhere('id', $candidato->nascimento_cidade_id)['nome'] ?? 'Cidade não encontrada' }}
                                    </td>

                                    <td class=" px-4 py-2 dark:text-white whitespace-nowrap" ><span class="cep">{{ $candidato->cep }}</span></td>
                                    <td class="telefone px-4 py-2 dark:text-white whitespace-nowrap" >{{ $candidato->telefone }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->email }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->nacionalidade }}</td>
                                    <td class="cpf px-4 py-2 dark:text-white whitespace-nowrap" >{{ $candidato->cpf }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap" id="rg">{{ $candidato->rg }}</td>
                                    <td class="data px-4 py-2 dark:text-white whitespace-nowrap" >{{ $candidato->data_expedicao }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->orgao_expeditor }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->uf_expedicao }}</td>
                                    <td class="px-4 py-2 dark:text-white whitespace-nowrap">{{ $candidato->escolaridade }}</td>
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
                        @if($candidatos->count() > 0)
                            {{ $candidatos->links(); }}
                        @endif
                    <div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>