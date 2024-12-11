<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:border-none w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Cadastro de candidatos</h1>

                <!-- Adicionando overflow-x-auto para rolagem horizontal -->
                <div class="mt-2">
                    <form class="grid grid-cols-1 gap-4" action="{{ route('candidato.store') }}" method="post">
                        @csrf

                        <div>
                            <div>   
                                <label for="nome_completo" class="block text-sm font-medium text-gray-700 dark:text-white">Nome Completo</label>
                                <input type="text" id="nome_completo" name="nome_completo" class="@error('nome_completo') is-invalid @enderror mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="Nome Completo" valuer="{{ old('nome_completo') }}">
                                @error('nome_completo')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nome_pai" class="block text-sm font-medium text-gray-700 dark:text-white ">Nome do Pai</label>
                                <input type="text" id="nome_pai" name="nome_pai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('nome_pai') }}">
                                @error('nome_pai')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="nome_mae" class="block text-sm font-medium text-gray-700 dark:text-white ">Nome da Mãe</label>
                                <input type="text" id="nome_mae" name="nome_mae" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('nome_mae') }}">
                                @error('nome_mae')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-white ">Telefone</label>
                                <input type="text" id="telefone" name="telefone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="(__) ____-____" value ="{{ old('telefone') }}"> 
                                @error('telefone')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div>
                                <label for="cpf" class="block text-sm font-medium text-gray-700 dark:text-white">CPF</label>
                                <input type="text" id="cpf" name="cpf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="___.___.___-__" value="{{ old('cpf') }}">
                                @error('cpf')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="rg" class="block text-sm font-medium text-gray-700 dark:text-white ">RG</label>
                                <input type="text" id="rg" name="rg" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 "  value="{{ old('rg') }}">
                                @error('rg')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
  
                        </div>

                        <div class="grid grid-cols-3 gap-4">   
                            <div>
                                <label for="nacionalidade" class="block text-sm font-medium text-gray-700 dark:text-white ">Nacionalidade</label>
                                <input type="text" id="nacionalidade" name="nacionalidade" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('nacionalidade') }}">
                                @error('nacionalidade')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="nascimento_pais_id" class="block text-sm font-medium text-gray-700 dark:text-white ">País de Nascimento</label>
                                <select id="nascimento_pais_id" name="nascimento_pais_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('nascimento_pais_id') }}">
                                    <option value="">Selecione</option>
                                    <option value="1">Brasil</option>
                                </select>
                                @error('nascimento_pais_id')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="estado_nascimento_id" class="block text-sm font-medium text-gray-700 dark:text-white ">Estado de Nascimento</label>
                                <select id="estado_nascimento_id" name="estado_nascimento_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('estado_nascimento_id') }}">
                                    <option value="">Selecione</option>
                                    @error('estado_nascimento_id')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>

                            <div>
                                <label for="nascimento_cidade_id" class="block text-sm font-medium text-gray-700 dark:text-white ">Cidade de Nascimento</label>
                                <select id="nascimento_cidade_id" name="nascimento_cidade_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('nascimento_cidade_id') }}">
                                    <option value="">Selecione um estado de nascimento</option>
                                </select>
                                @error('nascimento_cidade_id')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="estado_id" class="block text-sm font-medium text-gray-700 dark:text-white ">Estado</label>
                                <select id="estado_id" name="estado_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('estado_id') }}">
                                    <option value="">Selecione</option>
                                </select>
                                @error('estado_id')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="cidade_id" class="block text-sm font-medium text-gray-700 dark:text-white ">Cidade</label>
                                <select id="cidade_id" name="cidade_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('cidade_id') }}">
                                    <option value="">Selecione um estado</option>
                                </select>
                                @error('cidade_id')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="bairro" class="block text-sm font-medium text-gray-700 dark:text-white ">Bairro</label>
                                <input type="text" id="bairro" name="bairro" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('bairro') }}">
                                @error('bairro')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="endereco" class="block text-sm font-medium text-gray-700 dark:text-white ">Endereço</label>
                                <input type="text" id="endereco" name="endereco" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('endereco') }}">
                                @error('endereco')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="cep" class="block text-sm font-medium text-gray-700 dark:text-white ">CEP</label>
                                <input type="text" id="cep" name="cep" class="cep mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="_____-___" value="{{ old('cep') }}">
                                @error('cep')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label for="deficiencia" class="block text-sm font-medium text-gray-700 dark:text-white ">Possui Deficiência?</label>
                                <select id="deficiencia" name="deficiencia" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('deficiencia') }}">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                                @error('deficiencia')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="sexo" class="block text-sm font-medium text-gray-700 dark:text-white ">Sexo</label>
                                <select id="sexo" name="sexo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('sexo') }}">
                                    <option value="">Selecione</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Feminino</option>
                                </select>
                                @error('sexo')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="raca_id" class="block text-sm font-medium text-gray-700 dark:text-white ">Raça</label>
                                <select id="raca_id" name="raca_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('raca_id') }}">
                                </select>
                                @error('raca_id')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="estado_civil_id" class="block text-sm font-medium text-gray-700 dark:text-white ">Estado Civil</label>
                                <select id="estado_civil_id" name="estado_civil_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('estado_civil_id') }}">
                                    
                                </select>
                                @error('estado_civil_id')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white ">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="Seu email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>  

                            <div>
                                <label for="senha" class="block text-sm font-medium text-gray-700 dark:text-white ">Senha</label>
                                <input type="password" id="senha" name="senha" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " placeholder="Sua senha" value="{{ old('senha') }}"> 
                                @error('senha')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label for="data_expedicao" class="block text-sm font-medium text-gray-700 dark:text-white">Data de Expedição</label>
                                <input type="date" id="data_expedicao" name="data_expedicao" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('data_expedicao') }}">
                                @error('data_expedicao')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="orgao_expeditor" class="block text-sm font-medium text-gray-700 dark:text-white">Órgão Expedidor</label>
                                <input type="text" id="orgao_expeditor" name="orgao_expeditor" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('orgao_expeditor') }}">
                                @error('orgao_expeditor')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="uf_expedicao" class="block text-sm font-medium text-gray-700 dark:text-white">UF de Expedição</label>
                                <select id="uf_expedicao" name="uf_expedicao" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('uf_expedicao') }}">
                                    <option value="">Selecione</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                                @error('uf_expedicao')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="escolaridade" class="block text-sm font-medium text-gray-700 dark:text-white">Escolaridade</label>
                                <select id="escolaridade" name="escolaridade" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " value="{{ old('escolaridade') }}">
                                    <option value="">Selecione a escolaridade</option>
                                    <option value="Fundamental">Fundamental Completo</option>
                                    <option value="Fundamental Incompleto">Fundamental Incompleto</option>
                                    <option value="Medio">Médio Completo</option>
                                    <option value="Medio Incompleto">Médio Incompleto</option>
                                    <option value="Superior">Superior Completo</option>
                                    <option value="Superior Incompleto">Superior Incompleto</option>
                                    <option value="Pos Graduacao">Pós-Graduação</option>
                                    <option value="Pos Graduacao Incompleto">Pós-Graduação Incompleto</option>
                                    <option value="Mestrado">Mestrado</option>
                                    <option value="Doutorado">Doutorado</option>
                                </select>
                                @error('escolaridade')
                                    <div class="text-red-600 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cadastrar
                            </button>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                        <script>
                            // Objeto de cidades para evitar carregar todos no início
                            const cidades = @json($cidades);
                            const estados = @json($estados); // Supondo que a lista de estados também seja passada para o script

                            // Função para carregar as cidades do estado selecionado
                            function carregarCidades(estadoId, cidadeSelectId) {
                                const cidadeSelect = document.getElementById(cidadeSelectId);
                                cidadeSelect.innerHTML = '<option value="">Selecione uma cidade</option>'; // Limpa opções anteriores

                                cidades.forEach(cidade => {
                                    if (cidade.microrregiao.mesorregiao.UF.id == estadoId) {
                                        const option = document.createElement('option');
                                        option.value = cidade.id;
                                        option.textContent = cidade.nome;
                                        cidadeSelect.appendChild(option);
                                    }
                                });
                            }

                            // Evento no select de estado de nascimento
                            document.getElementById('estado_nascimento_id').addEventListener('change', function () {
                                const estadoId = this.value;
                                if (estadoId) {
                                    carregarCidades(estadoId, 'nascimento_cidade_id');
                                } else {
                                    document.getElementById('nascimento_cidade_id').innerHTML = '<option value="">Selecione</option>';
                                }
                            });

                            // Evento no select de estado
                            document.getElementById('estado_id').addEventListener('change', function () {
                                const estadoId = this.value;
                                if (estadoId) {
                                    carregarCidades(estadoId, 'cidade_id');
                                } else {
                                    document.getElementById('cidade_id').innerHTML = '<option value="">Selecione</option>';
                                }
                            });

                            // Carregar os estados no select de nascimento
                            const nascimentoPaisSelect = document.getElementById('estado_nascimento_id');
                            estados.forEach(estado => {
                                const option = document.createElement('option');
                                option.value = estado.id;
                                option.textContent = estado.nome;
                                nascimentoPaisSelect.appendChild(option);
                            });

                            // Carregar os estados no select de estado
                            const estadoSelect = document.getElementById('estado_id');
                            estados.forEach(estado => {
                                const option = document.createElement('option');
                                option.value = estado.id;
                                option.textContent = estado.nome;
                                estadoSelect.appendChild(option);
                            });

                            
                            const racas = @json($racas); 
                            const estadosCivis = @json($estadosCivis);

                            // Função para carregar as raças no select
                            function carregarRacas(selectId) {
                                const racaSelect = document.getElementById(selectId);
                                racaSelect.innerHTML = '<option value="">Selecione uma raça</option>'; // Limpa opções anteriores

                                racas.forEach(raca => {
                                    const option = document.createElement('option');
                                    option.value = raca.id;
                                    option.textContent = raca.descricao;
                                    racaSelect.appendChild(option);
                                });
                            }

                            // Função para carregar os estados civis no select
                            function carregarEstadosCivis(selectId) {
                                const estadoCivilSelect = document.getElementById(selectId);
                                estadoCivilSelect.innerHTML = '<option value="">Selecione um estado civil</option>'; // Limpa opções anteriores

                                estadosCivis.forEach(estadoCivil => {
                                    const option = document.createElement('option');
                                    option.value = estadoCivil.id;
                                    option.textContent = estadoCivil.descricao;
                                    estadoCivilSelect.appendChild(option);
                                });
                            }

                            // Carregar as raças no select de raças
                            carregarRacas('raca_id');

                            // Carregar os estados civis no select de estados civis
                            carregarEstadosCivis('estado_civil_id');


                        </script>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>