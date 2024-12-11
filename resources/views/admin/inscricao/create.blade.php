<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div id="errorMessage" class="absolute top-16 right-0 mt-3 mr-3 p-3 rounded-md text-white bg-red-600">
                    {{ session('error') }}
                </div>
            @endif

            <script>

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
            <div class="bg-white dark:bg-gray-800 dark:border-none w-full px-3 py-2 rounded-md">
                <h1 class="text-2xl font-bold my-2 dark:text-white">Cadastro de Inscrição</h1>

                <div class="mt-2">
                    <form class="grid grid-cols-1 gap-4" action="{{ route('inscricao.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="candidato_id" class="block text-sm font-medium text-gray-700 dark:text-white">Candidato</label>
                            <select id="candidato_id" name="candidato_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('cargo_id') }}">
                                <option value="">Selecione um Candidato</option>
                                @foreach ($candidatos as $candidato)    
                                    <option value="{{ $candidato->candidato_id }}" @if(old('candidato_id') == $candidato->candidato_id) selected @endif >{{ $candidato->nome_completo }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="block text-sm font-medium text-gray-700 dark:text-white">Seleção</label>
                            <select id="selecao_id" name="selecao_id"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Selecione uma Seleção</option>
                                @foreach ($selecoes as $selecao)
                                    <option value="{{ $selecao->selecao_id }}" @if(old('selecao_id') == $selecao->selecao_id) selected @endif>{{ $selecao->titulo }}</option>
                                @endforeach
                            </select>
                            @error('selecao_id')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
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