<x-app-layout>

    <livewire:dyp.indicadores.semaforo-dyp : idDyp="{{$id}}"/>

    <div class="mt-6 ">
        <div class="w-full max-w-full px-3">
            <div class="relative min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">

                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex flex-row items-center">
                                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-folder-open" aria-hidden="true"></span> DYP OT: <strong>{{$dyp->Ot_principal}}</strong>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-car" aria-hidden="true"></span> Patente: <strong>{{$dyp->Patente}}</strong>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-wrench" aria-hidden="true"></span> N° Siniestro: <strong>{{$dyp->NumeroSiniestro}}</strong>
                                </div>
                            </div>
                            {{--Estado del flujo--}}
                            <div id="alert-border-1" class=" p-2 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50" role="alert">

                                <div class="flex flex-wrap ">
                                    <div class="w-1/5 " >
                                        <div class="mb-3 pl-2 mr-5 w-auto " >
                                            <a href="javascript:imprSelec('divQR')" >{{($dyp->Vin!= null)?generarQR($dyp->Vin.'|'.$dyp->ID,100) : ''}}</a>

{{--
                                            <a href="javascript:imprSelec('divQR')" class="p-4">@if($dyp->Vin!= null)<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate($dyp->Vin)) !!} "> @endif</a>
--}}
                                        </div>
                                    </div>

                                    <div class="w-4/5 " >
                                        <div class="flex flex-wrap ">
                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Estado: <br><strong>{{$dyp->EstadoDyp}}</strong>
                                            </div>
                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Fecha apertura: <br><strong>{{date('Y-m-d H:i',strtotime($dyp->created_at))}}</strong>
                                            </div>

                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Fecha de entrega: <br><strong>{{($dyp->FechaEntrega != null) ? $dyp->FechaEntrega : $dyp->FechaEstimadaEntrega}}</strong>
                                            </div>
                                            <div class="p-3 w-1/4 text-sm font-medium">
                                                Tiempo de flujo: <br><strong>{{textoMinutos(MinutosEntreFechas(($dyp->FechaEntrega != null)?$dyp->FechaEntrega : date('Y-m-d H:i:s'),$dyp->created_at),false)}}</strong>
                                            </div>
                                            <div class="p-3 w-1/3 text-sm font-medium">
                                                Fecha Estimada de egreso: <br><strong>{{($dyp->FechaEstimadaEntrega != null) ? $dyp->FechaEstimadaEntrega : '-'}}</strong>
                                                <br><small><div onclick="Livewire.emit('openModal', 'dyp.componentes.modales.modal-fecha-egreso', {{json_encode(['idDyp'=>$dyp->ID])}})">Cambiar fecha <span class="fa phpdebugbar-fa-calendar" aria-hidden="true"></span></div></small>
                                            </div>

                                            <div class="p-3 w-1/4 text-sm ">
                                                <a href="/dyp/ordentrabajo/{{$dyp->ID}}" target="_blank" class="mr-3 inline-block px-4 py-1.5 font-bold text-center bg-blue-500  rounded-lg cursor-pointer leading-normal text-xs  shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md text-white">
                                                    <span class="fa phpdebugbar-fa-tasks" aria-hidden="true"> </span> Orden de trabajo
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="w-100  hidden" id="divQR">
                                    <p style="padding-left: 30px">{{($dyp->Vin!= null)?generarQR($dyp->Vin.'|'.$dyp->ID,250) : ''}}</p>
                                    <img src="{{asset('assets/img/Logo_Pompeyo.png')}}" width="300px">
                                </div>

                            </div>

                            {{--Cajas de datos--}}
                            <div class="flex flex-row overflow-auto">
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <livewire:dyp.componentes.datos-cliente : idDyp="{{$dyp->ID}}"/>
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <livewire:dyp.componentes.datos-vehiculo : idDyp="{{$dyp->ID}}"/>
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <livewire:dyp.componentes.datos-siniestro : idDyp="{{$dyp->ID}}"/>
                                </div>
                            </div>

                            {{--Datos sucursal--}}
                            {{--<div class="flex flex-row overflow-auto">
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <strong>Sucursal: </strong> <span>{{$dyp->Sucursal->Sucursal}}</span>
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <strong>Puesto en patio: </strong> {{$dyp->Cono}}
                                </div>
                                <div class="sm:w-1/1 md:w-1/3 lg:w-1/3 xl:w-1/3 m-2">
                                    <strong>N° OT: </strong> {{$dyp->Ot_principal}}
                                </div>
                            </div>--}}

                            <hr class="h-px my-8 bg-gray-500 border-0">

                            {{--Tareas--}}
                            <livewire:dyp.componentes.tareas-flujo : idDyp="{{$dyp->ID}}"/>

                            {{--footer--}}
                            <livewire:dyp.componentes.footer-flujo : idDyp="{{$dyp->ID}}"/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-app-layout>

