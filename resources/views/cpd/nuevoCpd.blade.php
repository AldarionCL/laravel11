<x-app-layout>
    <div class="flex flex-wrap mt-6 ">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        @if(isset($mensaje) && $mensaje != '')
                            <div class="relative w-full p-4 text-white bg-orange-500 rounded-lg">{{$mensaje}}</div>
                        @endif
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <h3>Crear Flujo CPD</h3>
                            {{--Formulario CPD--}}
                            <livewire:cpd.componentes.create.crear-cpd />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

