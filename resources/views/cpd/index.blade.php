<x-app-layout>

    <livewire:cpd.indicadores.indicador-cpd />

    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <h4 class="card-title">@yield('title-header', 'Dashboard CPD') </h4>
                            </div>
                            <livewire:cpd.buscadores.cpd-gerencia />

                            <div class="flex flex-col overflow-x-auto">
                                <div class="sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-x-auto">
                                            <livewire:cpd.datatables.lista-datatable/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

