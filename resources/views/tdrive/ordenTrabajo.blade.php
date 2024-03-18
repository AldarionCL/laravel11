<x-app-layout>
    <div class="flex flex-wrap mt-6 " id="divQR">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="overflow-x-auto" style="padding: 20px;">

                        <style >
                            #OrdenFrame
                            {
                                border: 2px solid darkblue; padding: 8px; float:left;
                            }

                            .frameQR
                            {
                                padding: 10px; margin-bottom: 3px; margin-top: 24px;  margin: 0 auto; align-items: center; text-align: center;

                            }

                            .frameOT
                            {
                                margin: 4px; padding:10px;
                            }

                            .frameCIA
                            {
                                padding: 5px;
                            }

                            .frameCliente
                            {
                                padding: 5px;
                            }

                            .frameValores
                            {
                                padding: 5px;
                            }

                            .frameTabla
                            {
                                padding: 5px; float: left; display: block;
                            }

                            .contenedor
                            {
                                width: 100%;
                            }

                            .inline-block{
                                display: inline-block;
                                margin-right: 40px;
                            }

                            .patente{
                                font-size: 24px; margin: 0 auto; font-weight: bold;
                            }

                        </style>
                        <livewire:tdrive.componentes.orden-trabajo : idTdrive="{{$tdrive->ID}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


