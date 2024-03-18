<x-app-layout>
    <div class="flex flex-wrap ">
        <div class="flex-none w-full max-w-full">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                <div class="flex-auto ">
                    <div class="overflow-x-auto" style="padding: 20px;">

                        <livewire:cpd.indicadores.semaforo-cpd : idCpd="{{$id}}"/>
                        <br>


                        <div id="alert-border-1" class=" p-2 mb-4 text-slate-800 border-t-4 border-purple-300 bg-purple-100" role="alert">
                            {{--Cajas de datos--}}
                            <div class="flex flex-wrap overflow-auto">
                                <div class="w-full lg:w-1/2 xl:w-1/2 pr-4 pb-4">
                                    <livewire:cpd.componentes.datos-siniestro : idCpd="{{$cpd->ID}}"/>

                                </div>
                                <div class="w-full lg:w-1/2 xl:w-1/2 pr-4 pb-4">
                                    <livewire:cpd.componentes.datos-vehiculo : idCpd="{{$cpd->ID}}"/>
                                </div>

                            </div>
                        </div>



                        {{--Linea de tiempo--}}
                        <livewire:cpd.indicadores.linea-estado : idCpd="{{$id}}"/>


                       <div class="mt-5 mb-5">
                           <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                               <div class="flex">
                                   <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                   <div>
                                       <button onclick="Livewire.emit('openModal', 'cpd.componentes.modales.modal-archivos', {{json_encode(['idCpd'=>$cpd->ID])}})"
                                               data-tooltip-target="tooltip-wallet" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
                                           <span class="fa fa-folder"></span>
                                           <small class="">Archivos</small>
                                       </button>
                                   </div>
                               </div>
                           </div>

                       </div>

                        <form id="formLog" name="formLog"  method="get" action="{{route('creaLogCPD',[$id])}}"
                              class="p-3">
                            <input type="hidden" name="idTarea" id="idTarea" value="">
                            <input type="hidden" name="tipoLog" id="tipoLog" value="comentarioEstado">
                            <ul class="w-100 text-xs font-mediartinez Sotoum text-gray-900 bg-white border border-gray-200 rounded-lg">
                                <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg bg-gray-300"><span class="fa fa-user text-xs"> </span> Comentarios del cpd</li>
                                <li class="w-full px-4 py-2 border-b border-gray-200" style="z-index: 99">
                                    Registro de comentarios asociados al flujo CPD del vehículo
                                </li>
                                <li style="max-height: 300px; overflow: scroll;">
                                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                        <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Comentario</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Creado por</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cpdlogs as $cpdlog)
                                            <tr>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="mb-0 leading-tight text-xs text-slate-400 text-xs"  style="white-space: pre-wrap"><span class="pl-2 fa {{($cpdlog->Tipo == 'COMENTARIO')?'fa-comment-o text-green-700': (($cpdlog->Tipo == 'ERROR')?'fa-times-circle text-red-700':'fa-info-circle text-sky-700')}}"> </span> {{$cpdlog->textolog}}</div>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-xs" >{{$cpdlog->Usuario->Email}}</p>
                                                    <p class="mb-0 leading-tight text-xs text-slate-400">({{$cpdlog->created_at}})</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                                <li class="w-full px-4 py-2 border-b border-gray-200">
                                    <p>Crear nuevo comentario:</p>
                                    <textarea required name="textolog" rows="3" placeholder="escriba su comentario...." class="focus:shadow-primary-outline min-h-unset text-sm leading-5.6 ease block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"></textarea>
                                    <div class="flex flex-wrap w-full">
                                        <div class="p-2 w-full">
                                            <button type="submit" id="botonLog" class="inline-block px-6 py-3 mr-3 font-bold text-center text-blue-500 uppercase align-middle transition-all bg-transparent border border-blue-500 rounded-lg cursor-pointer leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85 hover:shadow-md">Guardar comentario</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
