<x-app-layout>

    <livewire:cpd.indicadores.semaforo-cpd : idCpd="{{$id}}"/>

    <div class="mt-6 ">
        <div class="w-full max-w-full px-3">
            <div class="relative min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">

                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex flex-row items-center">
                                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-folder-open" aria-hidden="true"></span> CPD ID: <strong>{{$cpd->ID}}</strong>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-car" aria-hidden="true"></span> Patente: <strong>{{$cpd->Patente}}</strong>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                                    <span class="fa fa-wrench" aria-hidden="true"></span> N° Venta: <strong>{{$cpd->VentaID}}</strong>
                                </div>
                            </div>
                            {{--Estado del flujo--}}
                            <div id="alert-border-1" class=" p-2 mb-4 text-slate-800 border-t-4 border-purple-300 bg-purple-100" role="alert">
                                {{--Cajas de datos--}}
                                <div class="flex flex-row overflow-auto">
                                    <div class="sm:w-1/1 md:w-1/2 lg:w-1/2 xl:w-1/2 m-2">
                                        <livewire:cpd.componentes.datos-siniestro : idCpd="{{$cpd->ID}}"/>

                                        @if($idVenta)
                                            <a href="http://200.72.102.124/respaldo/htmlv1/Venta.html?{{$idVenta}}" target="_blank" class="inline-block px-3 mt-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-cyan-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md" >Ir a Venta Roma</a>
                                        @endif
                                        @if($idVpp)
                                            <a href="http://200.72.102.124/respaldo/htmlv1/Vpp.html?{{$idVpp}}" target="_blank" class="inline-block px-3 mt-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-cyan-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md" >Ir a VPP Roma</a>
                                        @endif
                                        @if($tieneInspeccion)
                                            <a href="{{route('formularioinspeccioncpd',$id)}}" target="_blank" class="inline-block px-3 mt-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-cyan-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md" >Formulario Inspección</a>
                                        @endif
                                        @if($tieneCalidad)
                                            <a href="{{route('formulariocalidadcpd',$id)}}" target="_blank" class="inline-block px-3 mt-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-cyan-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md" >Formulario Calidad</a>
                                        @endif
                                    </div>
                                    <div class="sm:w-1/1 md:w-1/2 lg:w-1/2 xl:w-1/2 m-2">
                                        <livewire:cpd.componentes.datos-vehiculo : idCpd="{{$cpd->ID}}"/>
                                    </div>

                                </div>
                            </div>

                                {{--Linea de tiempo--}}
                            <livewire:cpd.indicadores.linea-estado : idCpd="{{$cpd->ID}}"/>





                            <hr class="h-px my-8 bg-gray-500 border-0">
                            <div id="alert-border-2" class=" p-2 mb-4 text-slate-800 border-t-4 border-slate-300 bg-slate-100" role="alert">
                                <div class="flex flex-row align-content-center">
                                    <div class="mb-3 pl-2 mr-5 w-auto " >
                                        <h2>WIP</h2>
                                    </div>

                                    @foreach($wips as $w)
                                        <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 text-xs font-medium p-3 border-2 border-purple-300 m-2">
                                            <a href="{{(isset($wip[$w->ID]->ID)) ? route('tareacpd',[@$wip[$w->ID]->ID]) : ''}}"> <span class="fa {{$w->Icono}}"></span> {{str_replace('WIP - ','',$w->NombreTarea)}} <br><div class="{{colorEstado(@$wip[$w->ID]->Estado)}}"><small>{{(isset($wip[$w->ID])) ? $wip[$w->ID]->Estado : ''}}</small></div></a>
                                        </div>
                                    @endforeach
                                   {{-- <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 text-sm font-medium p-3 border-2 border-purple-300 m-2">
                                        <a href="{{(isset($wip[6]->ID)) ? route('tareacpd',[@$wip[6]->ID]) : ''}}"> <span class="fa fa-wrench"></span> Mecánica: <br><div class="{{colorEstado(@$wip[6]->Estado)}}"><small>{{(isset($wip[6])) ? $wip[6]->Estado : ''}}</small></div></a>
                                    </div>
                                    <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 text-sm font-medium p-3 border-2 border-purple-300 m-2">
                                        <a href="{{(isset($wip[7]->ID)) ? route('tareacpd',[@$wip[7]->ID]) : ''}}"><span class="fa fa-briefcase"></span> Repuestos: <br><div class="{{colorEstado(@$wip[7]->Estado)}}"><small>{{(isset($wip[7])) ? $wip[7]->Estado : ''}}</small></div></a>
                                    </div>
                                    <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 text-sm font-medium p-3 border-2 border-purple-300 m-2">
                                        <a href="{{(isset($wip[8]->ID)) ? route('tareacpd',[@$wip[8]->ID]) : ''}}"><span class="fa fa-car"></span> Dyp: <br><div class="{{colorEstado(@$wip[8]->Estado)}}"><small>{{(isset($wip[8])) ? $wip[8]->Estado : ''}}</small></div></a>
                                    </div>
                                    <div class="sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 text-sm font-medium p-3 border-2 border-purple-300 m-2">
                                        <a href="{{(isset($wip[9]->ID)) ? route('tareacpd',[@$wip[9]->ID]) : ''}}"><span class="fa fa-hand-stop-o"></span> Pulido: <br><div class="{{colorEstado(@$wip[9]->Estado)}}"><small>{{(isset($wip[9])) ? $wip[9]->Estado : ''}}</small></div></a>
                                    </div>--}}
                                </div>
                            </div>

                            {{--Tareas--}}
                            <livewire:cpd.componentes.tareas-flujo : idCpd="{{$cpd->ID}}"/>

                            {{--footer--}}
                            <livewire:cpd.componentes.footer-flujo : idCpd="{{$cpd->ID}}"/>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-app-layout>

