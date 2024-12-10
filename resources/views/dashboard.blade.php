<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-24 grid grid-cols-2 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-6 py-32 rounded-md text-start pt-3 flex flex-col" >
                <h3>{{$candidatos}}</h3>
                candidatos
            </div>
            <div class="bg-white px-6 py-32 rounded-md text-start pt-3 flex flex-col" >
                <h3>{{$inscricoes}}</h3>    
                inscrições
            </div>
            <div class="bg-white px-6 py-32 rounded-md text-start pt-3 flex flex-col" >
                <h3>{{$vagas}}</h3>    
                vagas
            </div>
            <div class="bg-white px-6 py-32 rounded-md text-start pt-3 flex flex-col" >
                <h3>{{$selecoes}}</h3>    
                seleções
            </div>

        </div>
    </div>
</x-app-layout>
