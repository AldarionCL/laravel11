<div class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
        <h6>Tareas del flujo</h6>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <table class="items-center min-w-full divide-y divide-gray-200 text-xs table-responsive">
                <thead class="align-bottom">
                <tr class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tarea</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Estado</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Solicitante</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Responsable</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Resolutor</th>
                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sla</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tareas as $tarea)
                <tr>
                    <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="{{($tarea->Tipo->NombreTarea == 'Taller') ? route('tallerdyp',[$tarea->ID]) : route('tareadyp',[$tarea->ID])}}" class="mb-0 font-semibold leading-tight text-xs">
                                <span class="fa fa-search"> </span>
                            </a>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 font-semibold leading-tight text-xs">{{$tarea->Tipo->NombreTarea}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 font-semibold leading-tight text-xs">
                            @if($tarea->Estado == 'Postergado')
                                <span class="fa fa-hourglass-1 text-orange-500"> {{$tarea->Estado}}</span>
                            @elseif($tarea->Estado == 'Rechazado')
                                <span class="fa fa-close text-red-500"> {{$tarea->Estado}}</span>
                            @elseif($tarea->Estado == 'Resuelto')
                                <span class="fa fa-check text-green-500"> {{$tarea->Estado}}</span>
                            @else
                                <span class="fa fa-folder-open-o text-blue-500"> {{$tarea->Estado}}</span>
                            @endif
                        </p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
{{--
                        <p class="mb-0 font-semibold leading-tight text-xs"> {{(isset($tarea->Solicitante->Email)) ? ucfirst(strtolower(@$tarea->Solicitante->Email)) : 'Sin info'}}</p>
--}}
                        <p class="mb-0 leading-tight text-xs text-slate-400"> {{(isset($tarea->Solicitante->Nombre)) ? ucfirst(strtolower(@$tarea->Solicitante->Nombre)) : 'Sin info'}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 font-semibold leading-tight text-xs"> {{(isset($tarea->Tipo->PerfilResponsable)) ? ucfirst(strtolower(@$tarea->Tipo->PerfilResponsable)) : 'Sin info'}}</p>
                        <p class="mb-0 leading-tight text-xs text-slate-400"> {{(isset($tarea->Responsable->Nombre)) ? ucfirst(strtolower(@$tarea->Responsable->Nombre)) : 'Sin info'}}</p>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <p class="mb-0 font-semibold leading-tight text-xs"> {{(isset($tarea->Resolutor->Nombre)) ? ucfirst(strtolower(@$tarea->Resolutor->Nombre)) : 'Sin info'}}</p>
                        <p class="mb-0 leading-tight text-xs text-slate-400"> {{(isset($tarea->FechaResolucion)) ? ucfirst(strtolower(@$tarea->FechaResolucion)) : 'Sin info'}}</p>
                    </td>

                    <td class="p-2  bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <span class="font-semibold leading-tight text-xs text-slate-400">
                            @if($tarea->Tipo->sla_invertido == 1)
                                <span class="fa fa-arrow-circle-right text-cyan-500"> </span> sla invertido <br>{{textoMinutos(MinutosEntreFechas((($tarea->FechaResolucion != null)?$tarea->FechaResolucion :date('Y-m-d H:i:s')),$tarea->created_at))}}
                            @elseif($tarea->Estado != 'Postergado')
                                @if($tarea->CumpleSla === 1)
                                    <span class="fa fa-check text-green-500"> </span> Resuelto en tiempo
                                @elseif($tarea->CumpleSla === 0)
                                    <span class="fa fa-hourglass-3 text-orange-500"> </span> Resuelto fuera de tiempo
                                @else($tarea->CumpleSla === null)
                                    <span class="fa fa-clock {{(textoSla($tarea->FechaSla, date('Y-m-d H:i:s'))=='Excedido') ? 'text-red-500' : 'text-green-500'}}"></span>  {{textoSla($tarea->FechaSla, date('Y-m-d H:i:s'))}}
                                @endif
                            @else
                                <span class="fa fa-clock-o text-yellow-500"> </span> Tiempo detenido
                            @endif
                        </span>
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


