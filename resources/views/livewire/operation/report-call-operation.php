<div>
    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">@yield('title-header', 'Reportes Call Center') </p>
                            </div>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="p-0 overflow-x-auto">
                                <div class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">Reportes Graficos Call Center</p>

                                    <div class="container mx-auto space-y-4 p-4 sm:p-0 mt-8">
                                        <div style="height: 40rem" class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                                                <livewire:livewire-column-chart
                                                    key="{{ $columnChartModel->reactiveKey() }}"
                                                    :column-chart-model="$columnChartModel"
                                                />
                                            </div>

                                            <div style="height: 50rem" class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                                                <livewire:livewire-pie-chart
                                                    key="{{ $pieChartModel->reactiveKey() }}"
                                                    :pie-chart-model="$pieChartModel"
                                                />
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
</div>

