<x-app-layout>
    <div class="flex flex-wrap mt-6 " id="divQR">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="overflow-x-auto" style="padding: 20px;">
                        <livewire:cpd.componentes.formulario-calidad : idCpd="{{$cpd->ID}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


