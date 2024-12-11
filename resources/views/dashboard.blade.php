<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 metrics-container flex flex-col font-nunito font-extrabold text-black dark:text-gray-200 max-w-6xl mx-auto mt-12">
        <div class="metrics-row flex flex-wrap gap-8 items-start justify-start w-full px-0">
            <div class="metric-card bg-white dark:bg-gray-800 rounded-3xl shadow-2xl flex flex-col justify-start flex-1 min-w-[240px] min-h-[250px] p-8 border border-gray-200">
                <div class="metric-value text-green-500 text-[50px] leading-[0.8] md:text-[40px]">{{$candidatos}}</div>
                <div class="metric-title text-[30px] leading-none mt-3">Candidatos</div>
                <div class="metric-description text-[20px] font-normal mt-3">Total de candidatos cadastrados.</div>
                <button onclick="window.location.href='{{ route('candidato') }}'" class="border border-green-500 bg-green-500 text-white py-2 px-4 rounded m-1 mt-4 w-full">Candidatos</button>
            </div>
            <div class="metric-card bg-white dark:bg-gray-800 rounded-3xl shadow-2xl flex flex-col justify-start flex-1 min-w-[240px] min-h-[250px] p-8 border border-gray-200">
                <div class="metric-value text-green-500 text-[50px] leading-[0.8] md:text-[40px]">{{$inscricoes}}</div>
                <div class="metric-title text-[30px] leading-none mt-3">Inscrições</div>
                <div class="metric-description text-[20px] font-normal mt-3">Total de inscrições realizadas.</div>
                <button onclick="window.location.href='{{ route('selecao') }}'" class="border border-green-500 bg-green-500 text-white py-2 px-4 rounded m-1 mt-4 w-full">Inscrições</button>
            </div>
            <div class="metric-card bg-white dark:bg-gray-800 rounded-3xl shadow-2xl flex flex-col justify-start flex-1 min-w-[240px] min-h-[250px] p-8 border border-gray-200">
                <div class="metric-value text-green-500 text-[50px] leading-[0.8] md:text-[40px]">{{$vagas}}</div>
                <div class="metric-title text-[30px] leading-none mt-3">Vagas</div>
                <div class="metric-description text-[20px] font-normal mt-3">Total de vagas cadastradas.</div>
                <button onclick="window.location.href='{{ route('vaga') }}'" class="border border-green-500 bg-green-500 text-white py-2 px-4 rounded m-1 mt-4 w-full">Vagas</button>
            </div>
            <div class="metric-card bg-white dark:bg-gray-800 rounded-3xl shadow-2xl flex flex-col justify-start flex-1 min-w-[240px] min-h-[250px] p-8 border border-gray-200">
                <div class="metric-value text-green-500 text-[50px] leading-[0.8] md:text-[40px]">{{$selecoes}}</div>
                <div class="metric-title text-[30px] leading-none mt-3">Seleções</div>
                <div class="metric-description text-[20px] font-normal mt-3">Total de seleções realizadas.</div>
                <button onclick="window.location.href='{{ route('selecao') }}'" class="border border-green-500 bg-green-500 text-white py-2 px-4 rounded m-1 mt-4 w-full">Seleções</button>
            </div>
        </div>
    </div>
</x-app-layout>
