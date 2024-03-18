<x-app-layout>

    <livewire:tdrive.indicadores.semaforo-tdrive : idTdrive="{{$id}}"/>

    <div class="mt-6 ">
        <div class="w-full max-w-full px-3">
            <div class="relative min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">

                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex flex-row items-center">
                                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-folder-open" aria-hidden="true"></span> TDRIVE OT: <strong>{{$tdrive->Ot_principal}}</strong>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-car" aria-hidden="true"></span> Patente: <strong>{{$tdrive->Patente}}</strong>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-wrench" aria-hidden="true"></span> N° Siniestro: <strong>{{$tdrive->NumeroSiniestro}}</strong>
                                </div>
                            </div>
                            {{--Estado del flujo--}}
                            <div id="alert-border-1" class=" p-2 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">

                                <div class="flex flex-wrap ">
                                    <div class="w-1/5 " >
                                        <div class="mb-3 pl-2 mr-5 w-auto " >
                                            <a href="javascript:imprSelec('divQR')" >{{($tdrive->Vin!= null)?generarQR($tdrive->Vin,100) : ''}}</a>

{{--
                                            <a href="javascript:imprSelec('divQR')" class="p-4">@if($tdrive->Vin!= null)<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate($tdrive->Vin)) !!} "> @endif</a>
--}}
                                        </div>
                                    </div>

                                    <div class="w-4/5 " >
                                        <div class="flex flex-wrap ">
                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Estado: <br><strong>{{$tdrive->EstadoTdrive}}</strong>
                                            </div>
                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Fecha apertura: <br><strong>{{date('Y-m-d H:i',strtotime($tdrive->created_at))}}</strong>
                                            </div>

                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Fecha de entrega: <br><strong>{{($tdrive->FechaEntrega != null) ? $tdrive->FechaEntrega : $tdrive->FechaEstimadaEntrega}}</strong>
                                            </div>
                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Tiempo de flujo: <br><strong>{{textoMinutos(MinutosEntreFechas(($tdrive->FechaEntrega != null)?$tdrive->FechaEntrega : date('Y-m-d H:i:s'),$tdrive->created_at),false)}}</strong>
                                            </div>
                                            <div class="p-3 w-1/3 text-sm font-medium">
                                                Fecha Estimada de egreso: <br><strong>{{($tdrive->FechaEstimadaEntrega != null) ? $tdrive->FechaEstimadaEntrega : '-'}}</strong>
                                                <br><small><div onclick="Livewire.emit('openModal', 'tdrive.componentes.modales.modal-fecha-egreso', {{json_encode(['idTdrive'=>$tdrive->ID])}})">Cambiar fecha <span class="fa phpdebugbar-fa-calendar" aria-hidden="true"></span></div></small>
                                            </div>

                                            <div class="p-3 w-1/4 text-sm ">
                                                <a href="/tdrive/ordentrabajo/{{$tdrive->ID}}" target="_blank" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-blue-500  rounded-lg cursor-pointer leading-normal text-xs  shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">
                                                    <span class="fa phpdebugbar-fa-tasks" aria-hidden="true"> </span> Orden de trabajo
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="w-100  hidden" id="divQR">
                                    <p style="padding-left: 30px">{{($tdrive->Vin!= null)?generarQR($tdrive->Vin,100) : ''}}</p>
                                    <img src="{{asset('assets/img/Logo_Pompeyo.png')}}" width="300px">
                                </div>

                            </div>

                            {{--Cajas de datos--}}
                            <div class="flex flex-row overflow-auto">
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <livewire:tdrive.componentes.datos-cliente : idTdrive="{{$tdrive->ID}}"/>
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <livewire:tdrive.componentes.datos-vehiculo : idTdrive="{{$tdrive->ID}}"/>
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <livewire:tdrive.componentes.datos-siniestro : idTdrive="{{$tdrive->ID}}"/>
                                </div>
                            </div>

                            {{--Datos sucursal--}}
                            {{--<div class="flex flex-row overflow-auto">
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <strong>Sucursal: </strong> <span>{{$tdrive->Sucursal->Sucursal}}</span>
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <strong>Puesto en patio: </strong> {{$tdrive->Cono}}
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <strong>N° OT: </strong> {{$tdrive->Ot_principal}}
                                </div>
                            </div>--}}

                            <hr class="h-px my-8 bg-gray-500 border-0 dark:bg-gray-700">

                            {{--Tareas--}}
                            <livewire:tdrive.componentes.tareas-flujo : idTdrive="{{$tdrive->ID}}"/>

                            {{--footer--}}
                            <livewire:tdrive.componentes.footer-flujo : idTdrive="{{$tdrive->ID}}"/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-app-layout>

