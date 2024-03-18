<x-app-layout>

<div class="mt-6 ">
    <div class="w-full max-w-full px-3">
        <div
            class="relative min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex flex-row items-center">

                            <div
                                class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                                <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                                    <h6>KPI</h6>
                                </div>
                                <div class="flex-auto px-0 pt-0 pb-2">
                                    <div class="p-0 overflow-x-auto">
                                        <livewire:kpi.buscadores.buscadorkpi />
                                        <livewire:kpi.buscadores.tablakpi />
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
